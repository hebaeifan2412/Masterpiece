{{-- filepath: c:\Users\Orange\Desktop\MasterPiece\School-Management-System\resources\views\welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NumaSchool</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Fonts and Styles --}}

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist-front/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>
  .icon-lg {
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    {{-- Mobile Menu --}}
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    {{-- Header --}}
<header class="site-navbar py-4 js-sticky-header fixed-top site-navbar-target" role="banner">
  <div class="container-fluid">
    <div class="d-flex align-items-center">
      <div class="site-logo mr-auto w-25"><a href="{{ url('/') }}"  class="nav-link "> <i class="fa-solid fa-graduation-cap  me-1"></i>NumaSchool</a></div>

      <div class="mx-auto text-center">
        <nav class="site-navigation position-relative text-right">
          <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block m-0 p-0">
            <li><a href="#home-section" class="nav-link font-weight-bold">Home</a></li>
            <li><a href="#about-us" class="nav-link font-weight-bold ">About Us </a></li>
            <li><a href="#teachers-section" class="nav-link font-weight-bold">Teachers</a></li>
            <li><a href="#contact-section" class="nav-link font-weight-bold">Contact Us</a></li>
          </ul>
        </nav>
      </div>

    </div>
  </div>
</header>

    {{-- Intro Section --}}
    <div class="intro-section" id="home-section">
      <div class="slide-1"  data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-2">
                  <h1 data-aos="fade-up" data-aos-delay="100">Discover a Smarter Way to Learn at NumaSchool</h1>
                  <p class="mb-4" data-aos="fade-up" data-aos-delay="200" >Empowering students from Grade 1 to Grade 10 through technology-driven learning,
                     passionate educators, and a supportive academic community that fosters success and growth.</p>
                </p>
                  <p data-aos="fade-up" data-aos-delay="300"><a href="{{ route('login') }}" class="btn bg-light py-3 px-5 text-dark ">log in</a></p>
                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <img src="{{ asset('dist-front/images/download.jpg') }}" alt="STEM Program" class="img-fluid custom-img w-100 mt-0">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section" id="about-us">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up">
            <h2 class="section-title">Why NumaSchool?

            </h2>
            <p> 
              At NumaSchool, we believe education is more than lessons and exams — it’s about nurturing smart,
               confident, and creative minds ready to shape the future.
              
              That’s why we built a smart, intuitive, and powerful school management platform designed for today’s challenge.</p>

              
          </div>
        </div>
        <div class="row g-4 my-4">
          <!-- Card 1 -->
          <div class="col-md-4">
            <div class="card h-100 border-0 shadow-lg counter-item">
              <div class="card-body text-center p-4">
                <div class="icon-lg bg-primary bg-opacity-10 text-primary rounded-circle mb-3 mx-auto">
                  <i class="fa-solid fa-lightbulb fa-lg text-light"></i>
                </div>
                <h4 class="card-title mb-3">Smarter Learning</h4>
                <p class="card-text">We focus on empowering students through technology and innovation.</p>
              </div>
            </div>
          </div>
        
          <!-- Card 2 -->
          <div class="col-md-4">
            <div class="card h-100 border-0  counter-item shadow-lg">
              <div class="card-body text-center p-4">
                <div class="icon-lg bg-success bg-opacity-10 text-success rounded-circle mb-3 mx-auto">
                  <i class="fas fa-chalkboard-teacher text-light fa-lg"></i>
                </div>
                <h4 class="card-title mb-3">Supportive Teachers</h4>
                <p class="card-text">We provide tools that simplify class management and improve student engagement.</p>
              </div>
            </div>
          </div>
        
          <!-- Card 3 -->
          <div class="col-md-4">
            <div class="card h-100 border-0 counter-item">
              <div class="card-body text-center p-4 ">
                <div class="icon-lg bg-info bg-opacity-10 text-info rounded-circle mb-3 mx-auto">
                  <i class="fas fa-school text-light fa-lg"></i>
                </div>
                <h4 class="card-title mb-3">Stronger Schools</h4>
                <p class="card-text">We help school leaders organize, analyze, and enhance the full learning experience.</p>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>


    <section class="py-5 counter-section bg-primary">
      <div class="container text-center text-white">
        <h2 class="section-title text-light mb-5">Our School in Numbers</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="counter-item p-4 rounded-3 bg-light bg-opacity-25 ">
              <div class="icon-wrapper mb-3">
                <i class="fas fa-users fa-3x text-primary"></i>
              </div>
              <h1 class="fw-bold counter mb-2 text-primary" data-target="{{ $studentsCount }}">0</h1>
              <p class="fs-5 text-uppercase text-primary opacity-75 letter-spacing-1">Students</p>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="counter-item p-4 rounded-3 bg-light bg-opacity-25 ">
              <div class="icon-wrapper mb-3">
                <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
              </div>
              <h1 class="fw-bold counter mb-2 text-primary" data-target="{{ $teachersCount }}">0</h1>
              <p class="fs-5 text-uppercase text-primary opacity-75 letter-spacing-1">Teachers</p>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="counter-item p-4 rounded-3 bg-light bg-opacity-25">
              <div class="icon-wrapper mb-3">
                <i class="fas fa-school fa-3x text-primary"></i>
              </div>
              <h1 class="fw-bold counter mb-2 text-primary" data-target="{{ $classesCount }}">0</h1>
              <p class="fs-5 text-uppercase text-primary opacity-75 letter-spacing-1">Classes</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <style>
    .counter-section {
      position: relative;
      overflow: hidden;
    }
     
    
    .counter-item {
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
      border-radius: 1rem;
   box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
    }
    
    .counter-item {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .letter-spacing-1 {
      letter-spacing: 1px;
    }
    
    .counter {
      font-size: 3.5rem;
      line-height: 1.2;
    }
    
    @media (max-width: 768px) {
      .counter {
        font-size: 2.5rem;
      }
    }
  </style>


<div class="site-section" id="teachers-section" >
  <div class="container" >
    <div class="row mb-5 justify-content-center">
      <div class="col-lg-7 mb-5 text-center">
        <h2 class="section-title text-dark">Our Faculty</h2>
        <p class="mb-5 text-dark">Our certified educators bring an average of 15 years' experience, combining academic expertise with a passion for student success.</p>
      </div>
    </div>

      <div class="row">
        @foreach($featuredTeachers as $teacher)
            <div class="col-md-6 col-lg-4 mb-4" style="background-color: #fff;">
                <div class="teacher text-center ">
                   @php
                    $imagePath = $teacher->user->image
                
                        ? asset('storage/' . $teacher->user->image)
                        : asset('image/user.jpg');
                @endphp
                    <img src="{{ $imagePath }}" alt="{{ $teacher->user->firstname }}" class="img-fluid w-50 rounded-circle mx-auto mb-4">
                    <div class="py-2">
                        <h2 class="text-light fw-bold">{{ $teacher->user->firstname }} {{ $teacher->user->lastname }}</h2>
                        <p class="position text-light">{{ $teacher->qualification }}</p>
                        {{-- <p>{{ $teacher->address ?? 'Experienced and passionate teacher.' }}</p> --}}
                    </div>
                </div>
            </div>
        @endforeach
      <!-- Add more teacher profiles -->
    </div>
  </div>
</div>

<div class="site-section py-5" id="contact-section">
  <div class="container">
    <div class="row align-items-center">
      <!-- Image Column (Left) -->
      <div class="col-lg-6 mb-4 mb-lg-0 d-none d-lg-block">
        <img src="{{ asset('dist-front/images/m.jpg') }}" 
             alt="Contact Us" 
             class="img-fluid rounded shadow">
      </div>
      
      <!-- Form Column (Right) -->
      <div class="col-lg-6">
        <div class="bg-white p-5 shadow rounded">
          <h2 class="section-title mb-4">Message Us</h2>
          
          <form method="post"  action="/contact" data-aos="fade">
             @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text"   name="first_name" class="form-control form-control-lg" placeholder="First name">
              </div>
              <div class="form-group col-md-6">
                <input type="text"  name="last_name"class="form-control form-control-lg" placeholder="Last name">
              </div>
            </div>

            <div class="form-group">
              <input type="text" name="subject" class="form-control form-control-lg" placeholder="Subject">
            </div>

            <div class="form-group">
              <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
            </div>
            
            <div class="form-group">
              <textarea class="form-control form-control-lg" name="message" rows="5" placeholder="Write your message here"></textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block py-3">
                Send Message <i class="fas fa-paper-plane ml-2"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  #contact-section {
    background-color: #f8f9fa;
  }
  
  .section-title {
    position: relative;
    padding-bottom: 15px;
    color: #2c3e50;
  }
  
  .section-title:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 3px;
    /* background: #3498db; */
  }
  
  .form-control-lg {
    border-radius: 0.3rem;
    border: 1px solid #ced4da;
    padding: 1rem 1.25rem;
  }
  
  .form-control-lg:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
  }
  
  textarea.form-control-lg {
    min-height: 150px;
  }
  
  .btn-block {
    border-radius: 50px;
    letter-spacing: 1px;
    font-weight: 600;
    transition: all 0.3s;
  }
  
  .btn-block:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
</style>
     
    {{-- Footer --}}
    <footer class="bg-dark text-white border-top pt-4 pb-2"> 

          {{-- <div class="d-flex  justify-content-around">
              <!-- About Column -->
              <div class="col-lg-4 col-md-6">
                  <div class="d-flex  align-items-start">
                    <div >  <img src="{{ asset('dash-front/images/logo.png') }}" class="me-3 logo-img " alt="NumaSchool logo" width="10" height="20">
                    </div>
                    <div class="ps-3"> 
                      <h4 class="mb-3 fw-bold border-bottom ms-5 p-2">About NumaSchool</h4>
                      <p class="text-light ms-2 p-2">Established in 2010, we're committed to academic excellence and holistic student development.</p>
                    </div>
                   </div>
              </div>
  
  
              <!-- Newsletter Column -->
              <div class="col-lg-4 col-md-12">
                  <h4 class="mb-4 fw-bold border-bottom pb-2">Subscribe</h4>
                  <form action="#" class="footer-subscribe">
                      <div class="input-group mb-3">
                          <input type="email" class="form-control bg-dark text-white rounded-0 border-primary" 
                                 placeholder="Enter your email" aria-label="Email">
                          <button class="btn btn-primary rounded-0" type="submit">
                              Subscribe
                          </button>
                      </div>
                      <small class="text-light">Stay updated with our latest news</small>
                  </form>
  
                  <!-- Social Links -->
                 
              </div>
          </div> --}}
  
          <!-- Copyright -->
          <div class=" ">
              <div class="col-md-12 text-center">
                <div class="mt-4 social-links">
                  <a href="#" class="text-white  p-2"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" class="text-white p-2"><i class="fab fa-twitter"></i></a>
                  <a href="#" class="text-white p-2"><i class="fab fa-linkedin-in"></i></a>
                  <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
              </div>
                  <p class="text-light mb-1">&copy; 2025 NumaSchool. All rights reserved.</p>
                  
              </div>
              
          </div>
      
  </footer> 
  
  

  
    </div> <!-- .site-wrap -->
  
<script>
  // Counter animation
  document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    
    counters.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      const count = +counter.innerText;
      const increment = target / speed;
      
      if(count < target) {
        const updateCount = () => {
          const text = +counter.innerText;
          if(text < target) {
            counter.innerText = Math.ceil(text + increment);
            setTimeout(updateCount, 1);
          } else {
            counter.innerText = target;
          }
        }
        updateCount();
      }
    });
  });
</script>
  
  
    <script src="{{ asset('dist-front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('dist-front/js/jquery-ui.js')}}"></script>
  <script src="{{ asset('dist-front/js/popper.min.js')}}"></script>
  <script src="{{ asset('dist-front/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('dist-front/js/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('dist-front/js/jquery.stellar.min.js')}}"></script>
  <script src="{{ asset('dist-front/js/jquery.countdown.min.js')}}"></script>
  <script src="{{ asset('dist-front/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ asset('dist-front/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{ asset('dist-front/js/aos.js')}}"></script>
  <script src="{{ asset('dist-front/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{ asset('dist-front/js/jquery.sticky.js')}}"></script>
  <script src="{{ asset('dist-front/js/main.js')}}"></script>
    
  </body>
</html>