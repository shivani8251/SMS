<div id="login-popup" class="mfp-hide">
  <div class="form-login-register">
      <div class="tabs mb-8">
          <ul class="nav nav-pills tab-style-01 text-capitalize justify-content-center" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">
                      <h3>Log In</h3>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">
                      <h3>Register</h3>
                  </a>
              </li>
          </ul>
      </div>
      <div class="tab-content">
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
              <div class="form-login">
                  <form>
                      <div class="font-size-md text-dark mb-5">Log In Your Account</div>
                      <div class="form-group mb-2">
                          <label for="username" class="sr-only">Username</label>
                          <input id="username" type="text" class="form-control" placeholder="Username">
                      </div>
                      <div class="form-group mb-3">
                          <div class="input-group flex-nowrap align-items-center">
                              <label for="password" class="sr-only">Password</label>
                              <input id="password" type="text" class="form-control" placeholder="Password">
                              <a href="#" class="input-group-append text-decoration-none">Forgot?</a>
                          </div>
                      </div>
                      <div class="form-group mb-6">
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="check">
                              <label class="custom-control-label text-dark" for="check">Remember</label>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-block font-weight-bold text-uppercase font-size-lg rounded-sm mb-8">
                      Log In
                      </button>
                  </form>
                  <div class="font-size-md text-dark mb-5">Or Log In With</div>
                  <div class="social-icon origin-color si-square">
                      <ul class="row no-gutters list-inline text-center">
                          <li class="list-inline-item si-facebook col-3">
                              <a target="_blank" title="Facebook" href="#">
                      <i class="fab fa-facebook-f">
                      </i>
                      <span>Facebook</span>
                      </a>
                          </li>
                          <li class="list-inline-item si-twitter col-3">
                              <a target="_blank" title="Twitter" href="#">
                              <i class="fab fa-twitter">
                              </i>
                              <span>Twitter</span>
                              </a>
                          </li>
                          <li class="list-inline-item si-google col-3">
                              <a target="_blank" title="Google plus" href="#">
                              <svg class="icon icon-google-plus-symbol">
                              <use xlink:href="#icon-google-plus-symbol"></use>
                              </svg>
                              <span>Google plus</span>
                              </a>
                                                              </li>
                          <li class="list-inline-item si-rss col-3">
                              <a target="_blank" title="RSS" href="#">
                              <i class="fas fa-rss"></i>
                              <span>RSS</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="tab-pane fade " id="register" role="tabpanel" aria-labelledby="register-tab">
              <div class="form-register">
                  <form>
                      <div class="font-size-md text-dark mb-5">Create Your Account</div>
                      <div class="form-group mb-2">
                          <label for="username-rt" class="sr-only">Username</label>
                          <input id="username-rt" type="text" class="form-control" placeholder="Username">
                      </div>
                      <div class="form-group mb-2">
                          <label for="email" class="sr-only">Email</label>
                          <input id="email" type="text" class="form-control" placeholder="Email Address">
                      </div>
                      <div class="form-group mb-2">
                          <label for="password-rt" class="sr-only">Username</label>
                          <input id="password-rt" type="password" class="form-control" placeholder="Password">
                      </div>
                      <div class="form-group mb-3">
                          <label for="r-password" class="sr-only">Username</label>
                          <input id="r-password" type="password" class="form-control" placeholder="Retype password">
                      </div>
                      <div class="form-group mb-8">
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="check-term">
                              <label class="custom-control-label text-dark" for="check-term">You agree with our Terms Privacy Policy and</label>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-block font-weight-bold text-uppercase font-size-lg rounded-sm">
                      Create an
                      account
                      </button>
                  </form>
              </div>
          </div>
      </div>
      <form>
      </form>
  </div>
</div>
<div id="search-popup" class="mfp-hide">
  <div class="search-popup text-center">
      <h2 class="mb-8">Search</h2>
      <div class="form-search">
          <form>
              <div class="row align-items-end">
                  <div class="form-search-item col-md-7 mb-4 mb-md-0 text-left bg-white">
                      <label for="key-word-02" class="pt-4 mb-0 text-dark font-weight-semibold font-size-lg lh-1">What</label>
                      <div class="input-group dropdown show pr-0 bg-transparent align-items-start">
                          <input type="text" autocomplete="off" id="key-word-02" class="form-control bg-transparent border-0 p-0 font-size-md lh-1" data-toggle="dropdown" aria-haspopup="true" placeholder="Ex: food, service, barber, hotel">
                          <button type="submit" class="btn text-dark btn-link input-group-append font-weight-normal p-0">
                          <i class="fal fa-search"></i>
                          </button>
                          <ul class="dropdown-menu form-search-ajax" aria-labelledby="key-word-02">
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  <svg class="icon icon-pizza">
                                  <use xlink:href="#icon-pizza"></use>
                                  </svg>
                                  <span class="font-size-md">Foods & Restaurants</span>
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  <svg class="icon icon-bed">
                                  <use xlink:href="#icon-bed"></use>
                                  </svg>
                                  <span class="font-size-md">Hotels & Resorts</span>
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  <svg class="icon icon-pharmaceutical">
                                  <use xlink:href="#icon-pharmaceutical"></use>
                                  </svg>
                                  <span class="font-size-md">Healths & Medicals</span>
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  <svg class="icon icon-cog">
                                  <use xlink:href="#icon-cog"></use>
                                  </svg>
                                  <span class="font-size-md">Services</span>
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  <svg class="icon icon-car">
                                  <use xlink:href="#icon-car"></use>
                                  </svg>
                                  <span class="font-size-md">Automotive</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="form-search-item col-md-5 mb-4 mb-md-0 text-left bg-white">
                      <label for="region-02" class="pt-4 mb-0 text-dark font-weight-semibold font-size-lg lh-1">Where</label>
                      <div class="input-group dropdown show pr-0 bg-transparent align-items-start">
                          <input type="text" autocomplete="off" id="region-02" class="form-control bg-transparent border-0 p-0 font-size-md lh-1" data-toggle="dropdown" aria-haspopup="true" placeholder="San Francisco">
                          <a href="#" class="input-group-append text-decoration-none" data-toggle="dropdown">
                                  <i class="fal fa-chevron-down"></i>
                                  </a>
                          <ul class="dropdown-menu form-search-ajax" aria-labelledby="region-02">
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  Austin
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  Boston
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  Chicago
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  Denver
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  Los Angeles
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  New York
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                   San Francisco
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  Seattle
                                  </a>
                              </li>
                              <li class="dropdown-item item">
                                  <a href="#" class="link-hover-dark-white">
                                  Washington
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </form>
      </div>
      <div class="heading mb-4">
          <div class="pt-8 font-size-lg mb-5">
              Or browse the highlights
          </div>
      </div>
      <div class="list-inline flex-wrap my-n2">
          <div class="list-inline-item py-2">
              <a href="explore-sidebar-grid.html" class="card icon-box-style-01 link-hover-dark-white">
                  <div class="card-body p-0">
                      <svg class="icon icon-pizza">
                      <use xlink:href="#icon-pizza"></use>
                      </svg>
                      <span class="card-text font-size-md font-weight-semibold mt-2 d-block">
                      Foods
                      </span>
                  </div>
              </a>
          </div>
          <div class="list-inline-item py-2">
              <a href="explore-sidebar-grid.html" class="card icon-box-style-01 link-hover-dark-white">
                  <div class="card-body p-0">
                      <svg class="icon icon-bed">
                      <use xlink:href="#icon-bed"></use>
                      </svg>
                      <span class="card-text font-size-md font-weight-semibold mt-2 d-block ">
                      Hotels
                      </span>
                  </div>
              </a>
          </div>
          <div class="list-inline-item py-2">
              <a href="explore-sidebar-grid.html" class="card icon-box-style-01 link-hover-dark-white">
                  <div class="card-body p-0">
                      <svg class="icon icon-brush2">
                      <use xlink:href="#icon-brush2"></use>
                      </svg>
                      <span class="card-text font-size-md font-weight-semibold mt-2 d-block">
                      Jobs
                      </span>
                  </div>
              </a>
          </div>
          <div class="list-inline-item py-2">
              <a href="explore-sidebar-grid.html" class="card link-hover-dark-white icon-box-style-01">
                  <div class="card-body p-0">
                      <svg class="icon icon-pharmaceutical">
                      <use xlink:href="#icon-pharmaceutical"></use>
                      </svg>
                      <span class="card-text font-size-md font-weight-semibold mt-2 d-block">
                      Medicals
                      </span>
                  </div>
              </a>
          </div>
          <div class="list-inline-item py-2">
              <a href="explore-sidebar-grid.html" class="card link-hover-dark-white icon-box-style-01">
                  <div class="card-body p-0">
                      <svg class="icon icon-cog">
                      <use xlink:href="#icon-cog"></use>
                      </svg>
                      <span class="card-text font-size-md font-weight-semibold mt-2 d-block">
                       Services
                      </span>
                  </div>
              </a>
          </div>
          <div class="list-inline-item py-2">
              <a href="explore-sidebar-grid.html" class="card link-hover-dark-white icon-box-style-01">
                  <div class="card-body p-0">
                      <svg class="icon icon-bag">
                      <use xlink:href="#icon-bag"></use>
                      </svg>
                      <span class="card-text font-size-md font-weight-semibold mt-2 d-block">
                      Shopping
                      </span>
                  </div>
              </a>
          </div>
          <div class="list-inline-item py-2">
              <a href="explore-sidebar-grid.html" class="card link-hover-dark-white icon-box-style-01">
                  <div class="card-body p-0">
                      <svg class="icon icon-car">
                      <use xlink:href="#icon-car"></use>
                      </svg>
                      <span class="card-text font-size-md font-weight-semibold mt-2 d-block">
                      Automotive
                      </span>
                  </div>
              </a>
          </div>
      </div>
      <a href="#" class="d-inline-block button-close mt-11 pt-1 text-dark font-size-lg font-weight-semibold text-decoration-none">
          <span class="d-block"><i class="fal fa-times"></i></span>
          <span class="d-block">Close</span>
      </a>
  </div>
</div><?php /**PATH C:\xampp\htdocs\indiapost\resources\views/user/layouts/popup.blade.php ENDPATH**/ ?>