@extends('layouts.app')
@section('scripts-css')
<style type="text/css">
    .imagebackground
    {
       height:550px;
       width:100%;

   }
   #work_thumb_1
   {
    height:350px;
    width:100%;
    text-align: center;
    padding: 10px 10px 10px 10px;    

}
.paragraph
{
    text-indent:40px;
    text-align: justify;
}
.margin-top
{
    margin-top: 50px;
}
</style>
@endsection
@section('content')
<div class="bg-light">
    <div id="carouselExampleIndicators" class=" carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/slider-2.jpg" class="imagebackground d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
          <img src="assets/img/slider-1.jpg" class=" imagebackground d-block w-100" alt="...">
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</div>
</div>
 <!-- <section class="home-slider carousel slide owl-carousel bg-light">
      <div class="slider-item" style="background-image: url('assets/img/slider-2.jpg')">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="mb-4"> Fastest-Growing Construction Company</h1>
              <p class="mb-0"><a href="#" target="_blank" class="btn btn-primary">Get Started</a></p>
              
            </div>
          </div>
        </div>

    </div> -->

      <!-- <div class="slider-item" style="background-image: url('assets/img/slider-1.jpg');">
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-8 col-sm-12 element-animate">
              <h1 class="mb-4">We Are Leading The Way Construction Works</h1>
              <p class="mb-0"><a href="#" target="_blank" class="btn btn-primary">Get Started</a></p>
            </div>
          </div>
        </div>
        
      </div>

  </div> -->
  <!-- END slider -->
  <div class="container-fluid py-5 bg-light">
    <div class="container-fluid">
        <div class="row  align-items-center justify-content-center">
          <div class="col-md-6">
            <h3 class="text-center heading border-bottom">OUR BIG PROBLEM</h3>
            <p class="paragraph">Belum ada platform yang menghubungkan perusahaan pemberi sponsor dengan EO yang mencari sponsor.Selain itu,Event Organizer sering bingung perusahaan apa saja yang membuka layanan sponsorship</p>
            <p class="paragraph">
               Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla euismod ultrices. Donec mi nulla, finibus convallis purus sit amet, dignissim lacinia erat. In hac habitasse platea dictumst. Quisque scelerisque metus ex, quis commodo metus pretium vitae. Maecenas ultricies accumsan pretium. In hac habitasse platea dictumst. Curabitur ut rhoncus libero, nec ornare neque. Cras semper aliquam justo sit amet tempus. Aliquam erat volutpat. In at mauris vehicula enim volutpat efficitur id ac elit. Fusce venenatis, sapien sit amet blandit pulvinar, dui nunc tincidunt ante, eu pretium tellus augue sed lectus. Phasellus at molestie magna, et dignissim eros.
           </p>
        </div>
         <div class="col-md-6">
            <img  src="assets/img/work_thumb_1.jpg" id="work_thumb_1">
         </div>
     </div>
    </div>
   </div>

   <div class="container margin-top">
       <center><h1 class="heading border-bottom">EOapp Solutions</h1></center>
       <p class="text-center">Aplikasi ini merupakan solusi untuk memudahkan Event Organizer dalam mencari sponsor dan juga mempermudah perusahaan dalam mencari Event Organizer yang layak untuk diberikan sponsorship.</p>
        <div class="row mb-5">
          <div class="col-lg-4 col-md-6 col-12 mb-3 ">
            <div class="media d-block media-feature text-center">
              <span class="flaticon-blueprint icon"></span>
              <div class="media-body">
                <h3 class="mt-0 text-black">Banyak Channel</h3>
                <p>Banyak daftar perusahaan yang menerima sponshorship</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12 mb-3 ">
            <div class="media d-block media-feature text-center">
              <span class="flaticon-building-1 icon"></span>
              <div class="media-body">
                <h3 class="mt-0 text-black">Mudah Diakses</h3>
                <p>Apply proposal yang mudah langsung ke perusahaan sponsorship yang dituju</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12 mb-3 ">
            <div class="media d-block media-feature text-center">
              <span class="flaticon-crane icon"></span>
              <div class="media-body">
                <h3 class="mt-0 text-black">General Contracting</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>
        </div>
   </div>
@endsection

@section('scripts-js')
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/main.js"></script>
@endsection

