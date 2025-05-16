<div class="site-section" id="teachers-section">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-lg-7 mb-5 text-center">
        <h2 class="section-title text-dark">Our Faculty</h2>
        <p class="mb-5 text-dark">
          Our certified educators bring an average of 15 years' experience, combining academic expertise
          with a passion for student success.
        </p>
      </div>
    </div>

    <div class="row">
      @foreach($featuredTeachers as $teacher)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="teacher text-center bg-white p-4 rounded shadow-sm h-100">
            @php
              $imagePath = $teacher->user->image
                ? asset('storage/' . $teacher->user->image)
                : asset('image/user.jpg');
            @endphp
            <img src="{{ $imagePath }}" alt="{{ $teacher->user->firstname }}"
                 class="img-fluid w-50 rounded-circle mx-auto mb-4">
            <div class="py-2">
              <h5 class="fw-bold text-dark">{{ $teacher->user->firstname }} {{ $teacher->user->lastname }}</h5>
              <p class="position text-muted">{{ $teacher->qualification }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
