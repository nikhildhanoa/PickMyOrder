<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.meta_header')    
    </head>
    <body>
        <div class="container-fluid chooseplan-banner">    
            @include('includes.header',['active' => ''])
        </div><!--end inner page banner-->
        <div class="container-fluid blog-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img src="assets/front-end/images/step two.png" alt="" class="img-responsive"/>
                        <h1>Champion</h1>

                        <div class="under-line">
                            <img src="{{asset('assets/front-end/images/under-line.jpg')}}" class="img-responsive">
                        </div>
                        <div class="strong-paras">
                            <p>Unsure? Consider this when making your decision, it <br>
                                takes an average of 12-weeks to cultivate a fitness lifestyle habit.</p>
                        </div>

                        <div class="prices-box">
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 price-table aos-init aos-animate" data-aos="fade-right">

                                    <div class="top-content1 text-center">

                                        <div class="title">
                                            <h3>4-Weeks</h3>
                                        </div>

                                        <div class="price">
                                            <strong>$</strong><span>249</span>/mo.
                                        </div>



                                    </div>
                                    <a class="get-started-link" href="{{route('customer.package.select',\App\Model\Customer::TOTAL_PACKAGE_4_WEEK)}}">
                                    <div class="bottom-content text-center">
                                        <span class="get-strated-text">Get Started</span>
                                    </div>
                                    </a>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 price-table aos-init aos-animate" data-aos="fade-up">

                                    <div class="top-content2 text-center">

                                        <div class="title">
                                            <h3>8-Weeks</h3>
                                        </div>

                                        <div class="price">
                                            <strong>$</strong><span>269</span>/mo.
                                        </div>



                                    </div>
                                    <a class="get-started-link" href="{{route('customer.package.select',\App\Model\Customer::TOTAL_PACKAGE_8_WEEK)}}">
                                    <div class="bottom-content text-center">
                                        <span class="get-strated-text">Get Started</span>
                                    </div>
                                        </a>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 price-table aos-init aos-animate" data-aos="fade-left">

                                    <div class="top-content3 text-center">

                                        <div class="title">
                                            <h3>12-Weeks</h3>
                                        </div>

                                        <div class="price">
                                            <strong>$</strong><span>289</span>/mo.
                                        </div>



                                    </div>
                                   <a class="get-started-link" href="{{route('customer.package.select',\App\Model\Customer::TOTAL_PACKAGE_12_WEEK)}}">
                                    <div class="bottom-content text-center">
                                        <span class="get-strated-text">Get Started</span>
                                    </div>
                                       </a>

                                </div>

                            </div> 
                        </div> 


                        <div class="jump-paras-bottom">
                            <p>All prices shown are based on terms. All plans are paid in advance.<br>
                                Plans automatically renew at the end of the agreed upon term unless cancelled prior to billing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>   <!--end blog-form-->
        @include('includes.footer') 
        @include('includes.meta_js')

    </body>
</html>