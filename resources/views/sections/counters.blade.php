<section class="py-5 counter-section bg-primary">
  <div class="container text-center text-white">
    <h2 class="section-title text-light mb-5">Our School in Numbers</h2>
    <div class="row g-4">
      
      <!-- Students -->
      <div class="col-md-4">
        <div class="counter-item p-4 rounded-3 bg-light bg-opacity-25">
          <div class="icon-wrapper mb-3">
            <i class="fas fa-users fa-3x text-primary"></i>
          </div>
          <h1 class="fw-bold counter mb-2 text-primary" data-target="{{ $studentsCount }}">0</h1>
          <p class="fs-5 text-uppercase text-primary opacity-75 letter-spacing-1">Students</p>
        </div>
      </div>

      <!-- Teachers -->
      <div class="col-md-4">
        <div class="counter-item p-4 rounded-3 bg-light bg-opacity-25">
          <div class="icon-wrapper mb-3">
            <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
          </div>
          <h1 class="fw-bold counter mb-2 text-primary" data-target="{{ $teachersCount }}">0</h1>
          <p class="fs-5 text-uppercase text-primary opacity-75 letter-spacing-1">Teachers</p>
        </div>
      </div>

      <!-- Classes -->
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
