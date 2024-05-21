<?php

namespace Cp\Menupage\Controllers;


use Cp\Menupage\Models\Menu;
use Cp\Menupage\Models\Page;
use App\Http\Controllers\Controller;
use Cp\Media\Models\Media;
use Cp\Menupage\Models\PageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Output\OutputPager;

class AdminMenupageController extends Controller
{
    public function menusAll()
    {
        menuSubmenu('menupage', 'menusAll');
        $data['menus'] = Menu::orderBy('drag_id')->latest()->paginate(30);
        return view('menupage::admin.menus.menusAll', $data);
    }


    public function menuStore(Request $request)
    {
        menuSubmenu('menupage', 'menusAll');
        $request->validate([
            'name_en' => 'string|required',
            'type' => 'string|required',
        ]);

        $menu =  new Menu();
        $menu->name_en = $request->name_en;
        $menu->name_bn = $request->name_bn;
        $menu->slug = getSlug($request->name_en,  $menu,  boolval($request->name_en));
        $menu->type = $request->type;
        $menu->link = $request->link ?: null;
        $menu->addedby_id = Auth::id();
        $menu->save();
        cache()->flush();
        toast('Menu successfully Created', 'success');
        return redirect()->back();
    }


    public function menuEdit(Menu $menu)
    {
        menuSubmenu('menupage', 'menusAll');
        $data['menu'] = $menu;
        return view('menupage::admin.menus.menuEdit', $data);
    }

    public function menuShow(Menu $menu)
    {
        menuSubmenu('menupage', 'menusAll');
        $data['menu'] = $menu;
        return view('menupage::admin.menus.menuShow', $data);
    }


    public function menuUpdate(Request $request, Menu $menu)
    {

        // dd($request->all());
        menuSubmenu('menupage', 'menusAll');
        $request->validate([
            'name_en' => 'string|required',
            'type' => 'string|required',
        ]);

        $menu->name_en = $request->name_en;
        $menu->name_bn = $request->name_bn;
        $menu->slug = getSlug($request->slug,  $menu,  boolval($request->slug));
        $menu->type        = $request->type;
        $menu->active      = $request->active ? 1 : 0;
        $menu->link        = $request->link ?? null;
        $menu->editedby_id = Auth::id();
        $menu->save();
        cache()->flush();
        toast('Menu successfully Updated', 'success');
        return redirect()->back();
    }

    public function menuDelete(Menu $menu)
    {
        menuSubmenu('menupage', 'menusAll');
        $menu->delete();
        cache()->flush();
        toast('Menu successfully deleted', 'success');
        return redirect()->back();
    }


    public function menuSort(Request $request)
    {
        foreach ($request->sorted_data as $key => $d) {
            DB::table('menus')->where('id', $d)->update(['drag_id' => ($key + 1)]);
        }
        return response()->json([
            'success' => true,
        ]);
    }




    public function pagesAll()
    {
        menuSubmenu('menupage', 'pagesAll');
        $data['menus'] = Menu::latest()->get();
        $data['pages'] = Page::orderBy('drag_id')->latest()->paginate(20);
        return view('menupage::admin.pages.pagesAll', $data);
    }


    public function pageStore(Request $request)
    {

        menuSubmenu('menupage', 'pagesAll');
        $request->validate([
            'name_en' => 'string|required',
        ]);
        $page  = new Page();
        $page->name_en = $request->name_en;
        $page->name_bn = $request->name_bn;
        $page->slug = getSlug($request->name_en,  $page,  boolval($request->name_en));
        $page->excerpt_en = $request->excerpt_en;
        $page->excerpt_bn = $request->excerpt_bn;
        $page->link  = $request->link ?? null;
        $page->active = $request->active ? 1 : 0;
        $page->addedby_id = Auth::id();
        $page->save();
        $page->menus()->attach($request->menus, ['addedby_id' => Auth::id()]);
        toast('Page successfully created', 'success');
        cache()->flush();
        return redirect()->back();
    }


    public function pageEdit(Page $page)
    {
        menuSubmenu('menupage', 'pagesAll');
        $data['page'] = $page;
        $data['menus'] = Menu::latest()->get();
        return view('menupage::admin.pages.pageEdit', $data);
    }




    public function pageUpdate(Request $request, Page $page)
    {
        menuSubmenu('menupage', 'pagesAll');
        $request->validate([
            'name_en' => 'string|required',
        ]);

        $page->name_en = $request->name_en;
        $page->name_bn = $request->name_bn;
        $page->slug = getSlug($request->slug,  $page,  boolval($request->slug));
        $page->excerpt_en = $request->excerpt_en;
        $page->excerpt_bn = $request->excerpt_bn;
        $page->active = $request->active ? 1 : 0;
        $page->link        = $request->link ?: null;
        $page->editedby_id = Auth::id();
        $page->save();
        $page->menus()->detach($page->menus);
        $page->menus()->attach($request->menus, ['editedby_id' => Auth::id()]);
        cache()->flush();
        toast('page successfully Updated', 'success');
        return redirect()->back();
    }

    public function pageDelete(Page $page)
    {
        menuSubmenu('menupage', 'pagesAll');
        $page->delete();
        cache()->flush();
        toast('Page successfully deleted', 'success');
        return redirect()->back();
    }


    public function pageSort(Request $request)
    {
        foreach ($request->sorted_data as $key => $d) {
            DB::table('pages')->where('id', $d)->update(['drag_id' => ($key + 1)]);
        }

        return response()->json([
            'success' => true,
        ]);
    }


    public function pageItemCreate($page_id)
    {
        $data['page'] = Page::find($page_id);
        $data['medias'] = Media::latest()->paginate(20);
        return view('menupage::admin.pageItems.pageItemCreate', $data);
    }




    public function pageItemStore(Request $request)
    {

        $request->validate([
            'name_en' => 'required',
            'description_en' => 'required',
        ]);
        $pageItem = new PageItem();
        $pageItem->page_id        = $request->page_id;
        $pageItem->name_en        = $request->name_en;
        $pageItem->name_bn        = $request->name_bn;
        $pageItem->description_en = $request->description_en;
        $pageItem->description_bn = $request->description_bn;
        $pageItem->editor = $request->editor ? 1 : 0;
        $pageItem->active = $request->active ? 1 : 0;
        $pageItem->addedby_id = Auth::id();
        $pageItem->save();

        toast('PageItem successfully created', 'success');
        return redirect()->back();
    }



    public function pageItemEdit(pageItem $pageItem)
    {
        $data['pageItems'] = PageItem::where('page_id', $pageItem->page_id)->get();
        $data['pageItem'] =  $pageItem;
        $data['medias'] = Media::latest()->paginate(20);
        return view('menupage::admin.pageItems.pageItemEdit', $data);
    }


    public function pageItemUpdate(Request $request, pageItem $pageItem)
    {



        $request->validate([
            'name_en' => 'required',
            'description_en' => 'required',
        ]);

        $pageItem->page_id     = $request->page_id;
        $pageItem->page_id        = $request->page_id;
        $pageItem->name_en        = $request->name_en;
        $pageItem->name_bn        = $request->name_bn;
        $pageItem->description_en = $request->description_en;
        $pageItem->description_bn = $request->description_bn;
        $pageItem->editor = $request->editor ? 1 : 0;
        $pageItem->active = $request->active ? 1 : 0;
        $pageItem->editedby_id = Auth::id();
        $pageItem->save();
        toast('PageItem successfully updated', 'success');
        return redirect()->back();
    }


    public function pageItemDelete(pageItem $pageItem)
    {
        $pageItem->delete();
        toast('PageItem successfully deleted', 'success');
        return redirect()->back();
    }

    public function menupageSearch(Request $request)
    {
        $type = $request->type;
        $q = $request->q;
        if($type == 'menu'){
            $menus = Menu::where(function ($qq) use ($q) {
            $qq->orWhere('name', 'like', "%" . $q . "%")
            ->orWhere('id', 'like', "%" . $q . "%");
            })->orderBy('name')
            ->paginate(100);
            $menus->appends($request->all());
            $page = View('menupage::admin.menus.searchData', ['menus' => $menus])->render();
            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        }else{
            
        }
       
    }
}