<section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        
                        
                        <div class="carousel-inner">
                            <?php 
                            $i=0;
                            $all_published_slider=DB::table('tbl_slider')
                                                 ->where('publication_status',1)
                                                 ->get(); 

                            ?>
                            
                            @foreach( $all_published_slider as $v_slider )
                            @if($i==0)

                            <div class="item active">
                            @else
                            <div class="item">
                            @endif

                                <div class="col-sm-4">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-8">
                                    <img src="{{URL::to($v_slider->slider_image)}}" style="height: 300px; width: 300px;" class="girl img-responsive" alt="" />
                                    <img src="{{URL::to('frontend/images/home/pricing.png')}}" class="pricing" alt="" />
                                </div>
                            </div>
                            <?php $i++ ?>
                            
                            @endforeach
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
