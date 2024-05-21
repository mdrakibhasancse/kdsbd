<footer>
    <div class="footer">
        {{-- <div class="footer-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-3">
                        <h4 class="widget-newsletter-title font1 font-weight-bold text-white">Sign Up to Newsletter</h4>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <p class="widget-newsletter-content ls-10 text-white mb-0">Get all the latest information on Events, Sales and Offers.</p>
                        <span class="widget-newsletter-content d-block font-weight-bold ls-10 text-white">Receive
                            $10 coupon for first shopping.</span>
                    </div>
                    <div class="col-md-10 col-lg-5">
                        <form action="#" class="mb-0">
                            <div class="footer-submit-wrapper d-flex">
                                <input type="email" class="form-control mb-0" placeholder="Enter your Email address..." required>
                                <button type="submit" class="btn btn-md btn-dark">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container">
            <div class="footer-middle">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-widget">
                            <div class="">
                            <h4 class="widget-title">ADDRESS:</h4>
                            <a href="#">{{ $ws->footer_address }}</a>
                            </div>
                            <div class="py-3">
                            <h4 class="widget-title">PHONE:</h4>
                            <a href="#">{{ $ws->contact_mobile }}</a>
                            </div>
                            <div class="">
                            <h4 class="widget-title">EMAIL:</h4>
                            <a href="mailto:{{$ws->contact_email}}">{{$ws->contact_email}}</a>
                            </div>
                        </div>
                            
                        <div class="social-icons mb-3 mb-lg-0">
                            <a href="{{ $ws->fb_url }}" class="social-icon social-facebook" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{ $ws->twitter_url }}" class="social-icon social-twitter" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="{{ $ws->linkedin_url }}" class="social-icon social-linkedin" target="_blank"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">Account</h4>
                            <ul class="mb-0">
                                <li>
                                    @if(Auth::check())
                                    <a href="{{route('user.dashboard')}}">My Account</a>
                                    @else
                                    <a href="{{ route('registerModal', ['register-modal-open']) }}" class="register-modal-lg">My Account</a>
                                    @endif
                                </li>
                                <li><a href="#">Track Your Order</a></li>
                                <li><a href="#">Payment Methods</a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="widget widget-sm">
                            <h4 class="widget-title">About</h4>
                            <ul class="links">
                                <li><a href="{{asset('/')}}page/terms-and-conditions">Terms And Conditions</a></li>
                                <li><a href="{{asset('/')}}page/support-policy">Support Policy</a></li>
                                <li><a href="{{asset('/')}}page/return-policy">Return Policy</a></li>
                                <li><a href="{{asset('/')}}page/privacy-policy">Privacy policy</a></li>
                               
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-2">
                        <div class="widget widget-sm">
                            <h4 class="widget-title">Features</h4>
                            <ul class="links">
                                {{-- <li><a href="#">FAQs</a></li> --}}
                                <li><a href="{{ route('sitemap')}}">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="w3-indigo py-2">
            <div class="text-center">
                <span class="footer-copyright"> &copy; {{ date('Y')}} Copyright :  kdsbd Online All Rights Reserved. Developed By : <a class="text-white" href="https://a2sys.co/">a2sys.co</a></span>
            </div>
        </div>
        <!-- End .footer-bottom -->
    </div>
</footer>