<div class="site-section py-5" id="contact-section">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Image Column -->
      <div class="col-lg-6 mb-4 mb-lg-0 d-none d-lg-block">
        <img src="{{ asset('dist-front/images/m.jpg') }}"
             alt="Contact Us"
             class="img-fluid rounded shadow">
      </div>

      <!-- Form Column -->
      <div class="col-lg-6">
        <div class="bg-white p-5 shadow rounded">
          <h2 class="section-title mb-4">Message Us</h2>
          <form method="POST" action="/contact" data-aos="fade">
            @csrf
            <div class="row">
              <div class="form-group col-md-6 mb-3">
                <input type="text" name="first_name" class="form-control form-control-lg" placeholder="First name">
              </div>
              <div class="form-group col-md-6 mb-3">
                <input type="text" name="last_name" class="form-control form-control-lg" placeholder="Last name">
              </div>
            </div>

            <div class="form-group mb-3">
              <input type="text" name="subject" class="form-control form-control-lg" placeholder="Subject">
            </div>

            <div class="form-group mb-3">
              <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
            </div>

            <div class="form-group mb-4">
              <textarea class="form-control form-control-lg" name="message" rows="5" placeholder="Write your message here"></textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block py-3">
                Send Message <i class="fas fa-paper-plane ms-2"></i>
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
