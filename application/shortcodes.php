<?php
# http://localhost/digiGoApp/application/shortcodes.php
require_once("../php/restrictAccess.php");

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>DigiGo App - Ticket Support for Teams</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/myStyles.css">

  </head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

      <!-- Main -->
        <div id="main">
          <div class="inner">

            <!-- Header -->
            <?php require_once("headerBar.php");?>

            <!-- Page Heading -->
            <div class="page-heading">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <h1>Shortcodes Page</h1>
                    <p><strong>Ramayana</strong> is free Bootstrap 4 CSS template from templatemo website. You can feel free to use it. Donec mattis tincidunt ipsum vel efficitur. Aliquam aliquam interdum rhoncus. Nam nec condimentum dolor, et pharetra nisi. In feugiat felis nec erat eleifend condimentum. Aliquam egestas convallis eros sed gravida. Curabitur consequat sit amet neque ac ornare.</p>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Tables -->
            <section class="tables">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section-heading">
                      <h2>Tables</h2>
                    </div>
                    <div class="default-table">
                      <table>
                        <thead>
                          <tr>
                            <th>Product no.</th>
                            <th>Description</th>
                            <th>Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>#1011</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$20.50</td>
                          </tr>
                          <tr>
                            <td>#1012</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$20.50</td>
                          </tr>
                          <tr>
                            <td>#1013</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$20.50</td>
                          </tr>
                          <tr>
                            <td>#1014</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$20.50</td>
                          </tr>
                          <tr>
                            <td>#1015</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$20.50</td>
                          </tr>
                        </tbody>
                      </table>
                      <ul class="table-pagination">
                        <li><a href="#">Previous</a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li><a href="#">Next</a></li>
                      </ul>
                    </div>
                    <div class="alternate-table">
                      <table>
                        <thead>
                          <tr>
                            <th>Product no.</th>
                            <th>Description</th>
                            <th>Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>#2005</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$19.95</td>
                          </tr>
                          <tr>
                            <td>#2006</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$19.95</td>
                          </tr>
                          <tr>
                            <td>#2007</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$19.95</td>
                          </tr>
                          <tr>
                            <td>#2008</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$19.95</td>
                          </tr>
                          <tr>
                            <td>#2008</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>$19.95</td>
                          </tr>
                        </tbody>
                      </table>
                      <ul class="table-pagination">
                        <li><a href="#">Previous</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">...</a></li>
                        <li class="active"><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li><a href="#">Next</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Forms -->
            <section class="forms">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section-heading">
                      <h2>Forms</h2>
                    </div>
                    <form id="contact" action="" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <fieldset>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Your name..." required="">
                          </fieldset>
                        </div>
                        <div class="col-md-6">
                          <fieldset>
                            <input name="email" type="text" class="form-control" id="email" placeholder="Your email..." required="">
                          </fieldset>
                        </div>
                        <div class="col-md-12">
                          <select name="category" id="category">
                            <option value="categories" selected>Select Category</option>
                            <option value="Featured">General</option>
                            <option value="Newest">Specific</option>
                            <option value="Low Price">Technical</option>
                            <option value="High Price">Application</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="radio-item">
                            <input name="demo-small" type="checkbox" id="demo-priority-small" value="small">
                            <label for="demo-priority-small">Small</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="radio-item">
                            <input name="demo-medium" type="checkbox" id="demo-priority-medium" value="medium">
                            <label for="demo-priority-medium">Medium</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="radio-item">
                            <input name="demo-large" type="checkbox" id="demo-priority-large" value="large" >
                            <label for="demo-priority-large">Large</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="circle-item">
                            <input name="demo-priority" type="radio" id="demo-small" value="16-20" checked>
                            <label for="demo-small">Age: 16 - 20</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="circle-item">
                            <input name="demo-priority" type="radio" id="demo-medium" value="21-30">
                            <label for="demo-medium">Age: 21 - 30</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="circle-item">
                            <input name="demo-priority" type="radio" id="demo-old" value="30+">
                            <label for="demo-old">Age: 30+</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
                        </div>
                        <div class="col-md-12">
                          <button type="submit" id="form-submit" class="button">Send Message</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </section>


            <!-- Tables -->
            <section class="buttons">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section-heading">
                      <h2>Buttons</h2>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="filled-rectangle-button">
                          <a href="#">Filled Button</a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="border-rectangle-button">
                          <a href="#">Border Button</a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="filled-radius-button">
                          <a href="#">Filled Button</a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="border-radius-button">
                          <a href="#">Border Button</a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="filled-rounded-button">
                          <a href="#">Filled Button</a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="border-rounded-button">
                          <a href="#">Border Button</a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="filled-icon-button">
                          <a href="#"><i class="fa fa-check"></i>Filled Button</a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="border-icon-button">
                          <a href="#"><i class="fa fa-check"></i>Border Button</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="filled-rectangle-button">
                          <a href="#">Filled Button</a>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="border-rectangle-button">
                          <a href="#">Border Button</a>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="filled-rounded-button">
                          <a href="#">Filled Button</a>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="border-rounded-button">
                          <a href="#">Border Button</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

          </div>
        </div>

      <!-- Sidebar -->
      <?php require_once("sideBarMenu.php");?>

    </div>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
</body>


  </body>

</html>
