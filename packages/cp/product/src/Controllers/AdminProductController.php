<?php

namespace Cp\Product\Controllers;


use Cp\Product\Models\ProductCategory;
use Cp\Product\Models\ProductSubCategory;
use App\Http\Controllers\Controller;
use Cp\Product\Models\BranchArea;
use Cp\Media\Models\Media;
use Cp\Product\Models\Branch;
use Cp\Product\Models\BranchCat;
use Cp\Product\Models\BranchSubCat;
use Cp\Product\Models\Product;
use Cp\Product\Models\ProductFile;
use Cp\Product\Models\Order;
use Cp\Product\Models\OrderItem;
use Cp\Product\Models\Payment;
use Cp\Product\Models\ProductCat;
use Cp\Product\Models\ProductSubcat;
use Cp\Product\Models\BranchProduct;
use Cp\Product\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class AdminProductController extends Controller
{
    public function productCategoriesAll()
    {
        menuSubmenu('product', 'productCategoriesAll');
        $data['categories'] = ProductCategory::latest()->paginate(30);
        return view('product::admin.productCategories.productCategoriesAll', $data);
    }


    public function productCategoryCreate()
    {
        menuSubmenu('product', 'productCategoriesAll');
        return view('product::admin.productCategories.productCategoryCreate');
    }


    public function productCategoryStore(Request $request)
    {

        // dd($request->all());
        menuSubmenu('product', 'productCategoriesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }

        $category =  new ProductCategory();
        $category->name_en = $request->name_en;
        $category->name_bn = $request->name_bn;
        $category->slug = getSlug($request->name_en,  $category,  boolval($request->name_en));
        $category->excerpt = $request->excerpt;
        $category->active = $request->active ? 1 : 0;
        $category->addedby_id = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_categories_images/' . $imageName, File::get($file));
            $category->image = $imageName;
        }
        $category->save();

        cache()->flush();
        toast('Category successfully Created', 'success');
        return redirect()->back();
    }


    public function productCategoryEdit(Request $request, ProductCategory $category)
    {
        menuSubmenu('product', 'productCategoriesAll');
        $data['category'] = $category;
        $lang = $request->lang;
        return view('product::admin.productCategories.productCategoryEdit', compact('category', 'lang'));
    }




    public function productCategoryUpdate(Request $request, ProductCategory $category)
    {
        menuSubmenu('product', 'productCategoriesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withInput()
                ->withErrors($validation);
        }


        $category->name_en = $request->name_en;
        $category->name_bn = $request->name_bn;
        $category->slug = getSlug($request->slug,  $category,  boolval($request->slug));
        $category->excerpt = $request->excerpt;
        $category->active = $request->active ? 1 : 0;
        $category->editedby_id = Auth::id();
        if ($request->hasFile('image')) {
            $old_file = 'product_categories_images/' . $category->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_categories_images/' . $imageName, File::get($file));
            $category->image = $imageName;
        }
        $category->save();


        cache()->flush();
        toast('Product Category successfully Updated', 'success');
        return redirect()->back();
    }

    public function productCategoryDelete(ProductCategory $category)
    {
        menuSubmenu('product', 'productCategoriesAll');
        $old_file = 'product_categories_images/' . $category->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $category->delete();
        cache()->flush();
        toast('Product Category successfully deleted', 'success');
        return redirect()->back();
    }


    public function categoryStatus(Request $request)
    {

        $category = ProductCategory::find($request->category);
        if (($category->active == 0)) {
            $category->active =  1;
            $active = true;
        } else {
            $category->active =  0;
            $active = false;
        }
        $category->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }



    public function productSubCategoriesAll()
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $data['subCategories'] =  ProductSubCategory::latest()->paginate(30);
        $data['categories'] = ProductCategory::latest()->get();
        return view('product::admin.productSubCategories.productSubCateoriesAll', $data);
    }

    public function productSubCategoryCreate()
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $data['categories'] = ProductCategory::latest()->get();
        return view('product::admin.productSubCategories.productSubCategoryCreate', $data);
    }


    public function productSubCategoryStore(Request $request)
    {

        menuSubmenu('product', 'productSubCategoriesAll');

        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
                'product_category_id' => 'required',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $subCategory = new ProductSubCategory();
        $subCategory->product_category_id = $request->product_category_id;
        $subCategory->name_en = $request->name_en;
        $subCategory->name_bn = $request->name_bn;
        $subCategory->slug = getSlug($request->name_en,  $subCategory,  boolval($request->name_en));
        $subCategory->active = $request->active ? 1 : 0;
        $subCategory->excerpt = $request->excerpt;
        $subCategory->addedby_id  = Auth::id();
        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_subCategories_images/' . $imageName, File::get($file));
            $subCategory->image = $imageName;
        }
        $subCategory->save();
        cache()->flush();
        toast('Sub Category successfully created', 'success');
        return redirect()->back();
    }


    public function productSubCategoryEdit(ProductSubCategory $subCategory)
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $data['subCategory'] = $subCategory;
        $data['categories'] = ProductCategory::latest()->get();
        return view('product::admin.productSubCategories.productSubCateoryEdit', $data);
    }



    public function productSubCategoryUpdate(Request $request, ProductSubCategory $subCategory)
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
                'product_category_id' => 'required',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $subCategory->product_category_id = $request->product_category_id;
        $subCategory->name_en = $request->name_en;
        $subCategory->name_bn = $request->name_bn;
        $subCategory->excerpt = $request->excerpt;
        $subCategory->slug = getSlug($request->slug,  $subCategory,  boolval($request->slug));
        $subCategory->active = $request->active ? 1 : 0;
        $subCategory->editedby_id = Auth::id();
        if ($request->hasFile('image')) {
            $old_file = 'product_subCategories_images/' . $subCategory->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_subCategories_images/' . $imageName, File::get($file));
            $subCategory->image = $imageName;
        }
        $subCategory->save();
        cache()->flush();
        toast('Sub Category successfully Updated', 'success');
        return redirect()->back();
    }

    public function productSubCategoryDelete(ProductSubCategory $subCategory)
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $old_file = 'product_subCategories_images/' . $subCategory->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $subCategory->delete();
        cache()->flush();
        toast('Product Sub Category successfully deleted', 'success');
        return redirect()->back();
    }


    public function subcategoryStatus(Request $request)
    {

        $subcategory = ProductSubCategory::find($request->subcategory);
        if (($subcategory->active == 0)) {
            $subcategory->active =  1;
            $active = true;
        } else {
            $subcategory->active =  0;
            $active = false;
        }
        $subcategory->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }





    public function branchesAll()
    {
        menuSubmenu('product', 'branchesAll');
        $data['branches'] = Branch::latest()->paginate(30);
        return view('product::admin.branches.branchesAll', $data);
    }


    public function branchCreate()
    {
        menuSubmenu('product', 'branchesAll');
        $data['divisions'] = DB::table('divisions')->select(['id', 'name'])->orderBy('name')->get();
        $data['districts'] = DB::table('districts')->select(['id', 'name', 'division_id'])->orderBy('name')->get();
        $data['thanas'] = DB::table('upazilas')->select(['id', 'name', 'district_id', 'division_id'])->orderBy('name')->get();
        return view('product::admin.branches.branchCreate', $data);
    }


    public function branchStore(Request $request)
    {

        menuSubmenu('product', 'branchesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
                'division_id' => 'required',
                'district_id' => 'required',
                'thana_id' => 'required',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }

        $branch =  new Branch();
        $branch->name_en = $request->name_en;
        $branch->name_bn = $request->name_bn;
        $branch->division_id = $request->division_id;
        $branch->district_id = $request->district_id;
        $branch->thana_id = $request->thana_id;
        $branch->active = $request->active ? 1 : 0;
        $branch->addedby_id = Auth::id();
        $branch->save();
        cache()->flush();
        toast('Branch successfully Created', 'success');
        return redirect()->back();
    }


    public function branchEdit(Branch $branch)
    {
        menuSubmenu('product', 'branchesAll');
        $data['branch'] =  $branch;
        $data['divisions'] = DB::table('divisions')->select(['id', 'name'])->orderBy('name')->get();
        $data['districts'] = DB::table('districts')->select(['id', 'name', 'division_id'])->orderBy('name')->get();
        $data['thanas'] = DB::table('upazilas')->select(['id', 'name', 'district_id', 'division_id'])->orderBy('name')->get();
        return view('product::admin.branches.branchEdit', $data);
    }




    public function branchUpdate(Request $request, Branch $branch)
    {
        menuSubmenu('product', 'branchesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $branch->name_en = $request->name_en;
        $branch->name_bn = $request->name_bn;
        // $branch->division_id = $request->division_id;
        // $branch->district_id = $request->district_id;
        // $branch->thana_id = $request->thana_id;
        $branch->active = $request->active ? 1 : 0;
        $branch->editedby_id = Auth::id();
        $branch->save();

        cache()->flush();
        toast('Branch successfully Updated', 'success');
        return redirect()->back();
    }

    public function branchDelete(Branch $branch)
    {
        menuSubmenu('product', 'branchesAll');
        $branch->branchAreas()->delete();
        $branch->delete();
        cache()->flush();
        toast('Branch successfully deleted', 'success');
        return redirect()->back();
    }


    public function branchShow(Branch $branch)
    {

         return view('product::admin.branches.branchShow', compact('branch'));
    }


    public function branchWiseProductManage(Branch $branch){
        $products = Product::get();
        foreach($products as $product){
            $bp = BranchProduct::where('branch_id', $branch->id)->where('product_id', $product->id)->first();
            if (!$bp) {
                $bp = new BranchProduct();
                $bp->branch_id =  $branch->id;
                $bp->product_id = $product->id;
                $bp->addedby_id = Auth::id();
                $bp->save();
            }
        }



        $productCats = ProductCat::groupBy('product_category_id')->pluck('product_category_id');
       

        foreach($productCats as $cat){
            $bc = BranchCat::where('branch_id', $branch->id)->where('category_id', $cat)->first();
            if (!$bc) {
                $bc = new BranchCat();
                $bc->branch_id =  $branch->id;
                $bc->category_id = $cat;
                $bc->addedby_id = Auth::id();
                $bc->save();
            }
        }

        $productSubcats = ProductSubcat::groupBy('product_subcategory_id')->pluck('product_subcategory_id');

        foreach($productSubcats as $subcat){
            $bsc = BranchSubcat::where('branch_id', $branch->id)->where('subcategory_id', $subcat)->first();
            if (!$bsc) {
                $bsc = new BranchSubcat();
                $bsc->branch_id =  $branch->id;
                $bsc->subcategory_id = $subcat;
                $bsc->addedby_id = Auth::id();
                $bsc->save();
            }
        }

       $products = $branch->products()->paginate(30);
       return view('product::admin.branches.branchWiseProductManage',compact('branch', 'products'));

    }



    public function branchProductStatus(Request $request)
    {

       $stock = BranchProduct::where('branch_id', $request->branch)->where('product_id', $request->product)->first();

        if (($stock->active == 0)) {
            $stock->active =  1;
            $active = true;
        } else {
            $stock->active =  0;
            $active = false;
        }
        $stock->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }



    public function branchArea(Branch $branch)
    {
        $areas = $branch->branchAreas()->paginate(30);
        return view('product::admin.branchAreas.branchArea', compact('branch', 'areas'));
    }





    public function branchAreaStore(Request $request)
    {

        menuSubmenu('product', 'branchesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }

        $branch = Branch::where('id', $request->branch_id)->first();
        $area =  new BranchArea();
        $area->name_en = $request->name_en;
        $area->name_bn = $request->name_bn;
        $area->Branch_id = $branch->id;
        $area->division_id = $branch->division_id;
        $area->district_id = $branch->district_id;
        $area->thana_id = $branch->thana_id;
        $area->active = $request->active ? 1 : 0;
        $area->addedby_id = Auth::id();
        $area->save();
        cache()->flush();
        toast('Branch Area successfully Created', 'success');
        return redirect()->back();
    }

    public function branchAreaEdit(BranchArea $brancharea)
    {
        menuSubmenu('product', 'branchesAll');
        $data['brancharea'] =  $brancharea;
        return view('product::admin.branchAreas.branchAreaEdit', $data);
    }


    public function branchAreaUpdate(Request $request, BranchArea $brancharea)
    {
        menuSubmenu('product', 'branchesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $brancharea->name_en = $request->name_en;
        $brancharea->name_bn = $request->name_bn;
        $brancharea->active = $request->active ? 1 : 0;
        $brancharea->editedby_id = Auth::id();
        $brancharea->save();

        cache()->flush();
        toast('Branch area successfully Updated', 'success');
        return redirect()->back();
    }


    public function branchAreaDelete(BranchArea $brancharea)
    {
        menuSubmenu('product', 'branchesAll');
        $brancharea->delete();
        cache()->flush();
        toast('Branch area successfully deleted', 'success');
        return redirect()->back();
    }



    public function branchAreaStatus(Request $request)
    {

        $brancharea = BranchArea::find($request->brancharea);
        if (($brancharea->active == 0)) {
            $brancharea->active =  1;
            $active = true;
        } else {
            $brancharea->active =  0;
            $active = false;
        }
        $brancharea->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }




    public function productsAll()
    {
        menuSubmenu('product', 'productsAll');
        $data['products'] = Product::latest()->paginate(30);
        return view('product::admin.products.productsAll', $data);
    }


    public function productShow(Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $data['product'] =  $product;
        return view('product::admin.products.productShow', $data);
    }

    public function productCreate()
    {
        menuSubmenu('product', 'productsAll');
        $data['categories'] = ProductCategory::latest()->get();
        $data['medias'] = Media::latest()->paginate(20);
        return view('product::admin.products.productCreate', $data);
    }




    public function productStore(Request $request)
    {
        menuSubmenu('product', 'productsAll');
        $request->validate([
            'name_en' => 'required',
            'price' => 'required',
            'featured_image' => 'nullable|image',
        ]);

        if ($request->tags) {
            foreach ($request->tags as $tag) {

                $t = Tag::where('name', $tag)->first();
                if (!$t) {
                    $t = new Tag;
                    $t->name = $tag;
                    $t->addedby_id = Auth::id();
                    $t->save();
                }
            }
        }


        $product = new Product();
        $product->name_en    = $request->name_en;
        $product->name_bn    = $request->name_bn;
        $product->slug = getSlug($request->name_en,  $product,  boolval($request->name_en));
        $product->price   = $request->price ?? 0.00;
        $product->discount  = $request->discount ?? 0.00;
        $product->discount_price = $request->discount ?? 0.00;
        $product->final_price = $request->price - $product->discount;
        $product->unit   = $request->unit;
        $product->excerpt_en = $request->excerpt_en;
        $product->excerpt_bn = $request->excerpt_bn;
        $product->description_en = $request->description_en;
        $product->description_bn = $request->description_bn;
        $product->editor = $request->editor ? 1 : 0;
        $product->active = $request->active ? 1 : 0;
        $product->tags = $request->tags;
        $product->addedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = $product->id . time() . $ext;
            Storage::disk('public')->put('product_images/' . $imageName, File::get($file));
            $product->featured_image = $imageName;
        }

        if ($request->tags) {
            $product->tags = implode(', ', $request->tags);
        } else {
            $product->tags = null;
        }

        $product->save();

        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = ProductCat::where('product_category_id', $cat)->where('product_id', $product->id)->first();
                if (!$c) {
                    $c = new ProductCat;
                    $c->product_category_id = $cat;
                    $c->product_id = $product->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
                $subcatIds = $request->input("subcategories_{$cat}");
                if ($subcatIds) {
                    foreach ($subcatIds as $sub) {
                        $c = ProductSubcat::where('product_subcategory_id', $sub)->where('product_id', $product->id)->first();
                        if (!$c) {
                            $c = new ProductSubcat;
                            $c->product_subcategory_id = $sub;
                            $c->product_id = $product->id;
                            $c->addedby_id = Auth::id();
                            $c->save();
                        }
                    }
                }
            }
        }



        toast('Product successfully created', 'success');
        return redirect()->back();
    }






    public function productEdit(Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $data['product'] =  $product;
        $data['categories'] = ProductCategory::latest()->get();
        $data['medias'] = Media::latest()->paginate(20);
        $data['ots'] = $data['product']->tags ? explode(", ", $data['product']->tags) : null;
        return view('product::admin.products.productEdit', $data);
    }


    public function productUpdate(Request $request, Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $request->validate([
            'name_en' => 'required',
            'price' => 'required',
            'featured_image' => 'nullable|image',
        ]);

        if ($request->tags) {
            foreach ($request->tags as $tag) {

                $t = Tag::where('name', $tag)->first();
                if (!$t) {
                    $t = new Tag;
                    $t->name = $tag;
                    $t->addedby_id = Auth::id();
                    $t->save();
                }
            }
        }

        $product->name_en    = $request->name_en ;
        $product->name_bn    = $request->name_bn;
        $product->slug = getSlug($request->name_en,  $product,  boolval($request->name_en));
         $product->price   = $request->price ?? 0.00;
        $product->discount  = $request->discount ?? 0.00;
        $product->discount_price = $request->discount ?? 0.00;
        $product->final_price = $request->price - $product->discount;
        $product->unit   = $request->unit;
        $product->excerpt_en = $request->excerpt_en;
        $product->excerpt_bn = $request->excerpt_bn;
        $product->description_en = $request->description_en;
        $product->description_bn = $request->description_bn;
        $product->editor = $request->editor ? 1 : 0;
        $product->active = $request->active ? 1 : 0;
        $product->tags = $request->tags;
        $product->addedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = $product->id . time() . $ext;
            Storage::disk('public')->put('product_images/' . $imageName, File::get($file));
            $product->featured_image = $imageName;
        }

        if ($request->tags) {
            $product->tags = implode(', ', $request->tags);
        } else {
            $product->tags = null;
        }

        $product->save();


        $product->categories()->detach();
        $product->subcategories()->detach();
        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = ProductCat::where('product_category_id', $cat)->where('product_id', $product->id)->first();
                if (!$c) {
                    $c = new ProductCat;
                    $c->product_category_id = $cat;
                    $c->product_id = $product->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
                $subcatIds = $request->input("subcategories_{$cat}");
                if ($subcatIds) {
                    foreach ($subcatIds as $sub) {
                        $c = ProductSubcat::where('product_subcategory_id', $sub)->where('product_id', $product->id)->first();
                        if (!$c) {
                            $c = new ProductSubcat;
                            $c->product_subcategory_id = $sub;
                            $c->product_id = $product->id;
                            $c->addedby_id = Auth::id();
                            $c->save();
                        }
                    }
                }
            }
        }


        toast('Product successfully updated', 'success');
        return redirect()->back();
    }


    public function productDelete(Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $old_file = 'product_images/' . $product->featured_image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $product->delete();
        toast('Product successfully deleted', 'success');
        return redirect()->back();
    }


    public function productStatus(Request $request)
    {

        $product = Product::find($request->product);
        if (($product->active == 0)) {
            $product->active =  1;
            $active = true;
        } else {
            $product->active =  0;
            $active = false;
        }
        $product->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }



    public function productTags(Request $request)
    {

        $tags = Tag::where('name', 'like', '%' . $request->q . '%')
            ->select(['name'])->take(30)->get();
        if ($tags->count()) {
            if ($request->ajax()) {
                return $tags;
            }
        } else {
            if ($request->ajax()) {
                return $tags;
            }
        }
    }

    public function productSearch(Request $request)
    {
        $type = $request->type;
        $q = $request->q;
        if ($type == 'product') {
            $products = Product::where(function ($qq) use ($q) {
                $qq->orWhere('name_en', 'like', "%" . $q . "%")
                    ->orWhere('name_bn', 'like', "%" . $q . "%")
                    ->orWhere('price', 'like', "%" . $q . "%")
                    ->orWhere('id', 'like', "%" . $q . "%");
            })->orderBy('name_en')
                ->paginate(100);
            $products->appends($request->all());
            $page = View('product::admin.products.searchData', ['products' => $products])->render();
            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        } elseif ($type == 'category') {
            $categories = ProductCategory::where(function ($qq) use ($q) {
                $qq->orWhere('name_en', 'like', "%" . $q . "%")
                    ->orWhere('name_bn', 'like', "%" . $q . "%")
                    ->orWhere('id', 'like', "%" . $q . "%");
            })->orderBy('name_en')
                ->paginate(100);
            $categories->appends($request->all());
            $page = View('product::admin.productCategories.searchData', ['categories' => $categories])->render();
            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        } elseif ($type == 'subcategory') {
            $subCategories = ProductSubCategory::where(function ($qq) use ($q) {
                $qq->orWhere('name_en', 'like', "%" . $q . "%")
                    ->orWhere('name_bn', 'like', "%" . $q . "%")
                    ->orWhere('id', 'like', "%" . $q . "%");
            })->orderBy('name_en')
                ->paginate(100);
            $subCategories->appends($request->all());
            $page = View('product::admin.productSubCategories.searchData', ['subCategories' => $subCategories])->render();
            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        } elseif ($type == 'branch') {
            $branches = Branch::where(function ($qq) use ($q) {
                $qq->orWhere('name_en', 'like', "%" . $q . "%")
                    ->orWhere('name_bn', 'like', "%" . $q . "%")
                    ->orWhere('id', 'like', "%" . $q . "%");
            })->orderBy('name_en')
                ->paginate(100);
            $branches->appends($request->all());
            $page = View('product::admin.branches.searchData', ['branches' => $branches])->render();
            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        } elseif ($type == 'branchArea') {
            $branch = Branch::where('id', $request->branch)->first();
            $areas = $branch->branchAreas()->where(function ($qq) use ($q) {
                $qq->orWhere('name_en', 'like', "%" . $q . "%")
                    ->orWhere('name_bn', 'like', "%" . $q . "%")
                    ->orWhere('id', 'like', "%" . $q . "%");
            })->orderBy('name_en')
                ->paginate(100);
            $areas->appends($request->all());
            $page = View('product::admin.branchAreas.searchData', ['areas' => $areas])->render();
            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        }elseif ($type == 'brandwiseproduct') {
            $branch = Branch::where('id', $request->branch)->first();

            $products = $branch->products()->where(function ($qq) use ($q) {
                $qq->orWhere('name_en', 'like', "%" . $q . "%")
                    ->orWhere('name_bn', 'like', "%" . $q . "%")
                    ->orWhere('price', 'like', "%" . $q . "%")
                    ->orWhere('product_id', 'like', "%" . $q . "%");
            })->orderBy('name_en')
                ->paginate(100);
            $products->appends($request->all());
            $page = View('product::admin.branches.searchData', ['products' => $products, 'branch' => $branch])->render();
            return response()->json([
                'success' => true,
                'page' => $page,
            ]);
        } else {
        }
    }



      public function productAddStock(Request $request){

        $stock = BranchProduct::where('branch_id', $request->branch)->where('product_id', $request->product)->first();
        

        if(request()->ajax())
        {

            if($stock)
            {     
             $stock->stock_qty = $request->qty;
             $stock->save();  
            }
                
            return response()->json([
                'success' => true, 
                'current_stock' => $stock->stock_qty,
            ]);
                
        }
           
            
    }

   



    public function orderList()
    {
        menuSubmenu('order', 'orderList');
        $data['orders'] = Order::latest()->paginate(30);
        return view('product::admin.orders.orderList', $data);
    }

    public function orderDeatils(Order $order)
    {
        menuSubmenu('order', 'orderList');
        return view('product::admin.orders.orderDeatils', compact('order'));
    }

    public function orderStatus(Request $request, Order $order)
    {
        if ($request->order_status == 'pending') {
            $order->order_status = $request->order_status;
            $order->pending_at = Carbon::now();
            $order->save();
        }elseif ($request->order_status == 'confirmed') {
            $order->order_status = $request->order_status;
            $order->delivered_at = Carbon::now();
            $order->save();
        } elseif ($request->order_status == 'canceled') {
            $order->order_status = $request->order_status;
            $order->canceled_at = Carbon::now();
            $order->save();
        }

        toast('Order Status Change Successfully', 'success');
        return redirect()->back();
    }



    public function orderPayment(Request $request, Order $order)
    {

        $request->validate([
            'payment_date'   => 'required',
            'payment_method' => 'required',
            'paid_amount'     => 'required',
        ]);

        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->user_id = $order->user_id;
        $payment->branch_id = $order->branch_id;
        $payment->note = $request->note;
        $payment->payment_status = $request->payment_status;
        $payment->payment_method = $request->payment_method;
        $payment->transaction_id = $request->transaction_id;
        $payment->previous_due_amount = $order->due();
        $payment->paid_amount = $request->paid_amount;
        $payment->due_amount = $payment->previous_due_amount - $payment->paid_amount;
        $payment->payment_date = $request->payment_date;
        $payment->payment_status = 'paid';
        $payment->addedby_id =  Auth::id();
        $payment->save();
        if ($order->due() > 0.99) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'paid';
        }
        $order->paid_amount = $order->paid_amount += $request->paid_amount;
        $order->editedby_id == Auth::id();
        $order->save();

        toast('Order Payment Successfully', 'success');
        return redirect()->back();
    }


    public function orderDelete(Request $request, Order $order)
    {
        $order->delete();
        $order->orderItems()->delete();
        toast('Order Successfully Deleted', 'success');
        return redirect()->back();
    }

    public function orderItemDelete(Request $request, OrderItem $orderItem)
    {
        $order = Order::find($request->order_id);
        $order->total_amount = $order->total_amount - $orderItem->total_cost;
        if ($order->due() == $order->total_amount) {
            $order->payment_status = "unpaid";
        } elseif ($order->due() > 0) {
            $order->payment_status = "partial";
        } else {
            $order->payment_status = "paid";
        }
        $order->save();
        $orderItem->delete();
        toast('Order Item Successfully Deleted', 'success');
        return redirect()->back();
    }
}