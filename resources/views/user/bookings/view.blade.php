@extends('layouts.user') 

@section('content')
<!--Section_Start-->
  <section class="booking_management_container">
      <div class="container">
          <div class="row">
              <div class="col-sm-6">
                    <div class="dropdown">
                        <a class="btn btn-light btn-block" href="#" type="sidebar_button">Profile
                        </a>
                    </div>
                    <div class="dropdown">
                      <a class="btn btn-light btn-block" href="#" type="sidebar_button">Change Password
                      </a>
                    </div>
                    <div class="dropdown">
                      <a class="btn btn-light btn-block" href="#" type="sidebar_button">Delete Account
                      </a>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-light btn-block" href="#" type="sidebar_button">Logout
                        </a>
                    </div>
              </div>
              <div class="col-lg-6 other">
                    <h2>Booking Management</h2>
                  <table id="table_view" class="display">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Booking ID</th>
                              <th>Provider</th>
                              <th>Host Name</th>
                              <th>Host Location</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>#12271231</td>
                              <td>#12221213</td>
                              <td>#beno</td>
                              <td>Codegama</td>
                              <td>MG Road</td>
                              <td>Not registered</td>
                          </tr>
                          <tr>
                              <td>#11221323</td>
                              <td>#11221323</td>
                              <td>#jeno</td>
                              <td>Instarama</td>
                              <td>Phase-1 ELCTA</td>
                              <td>Verified</td>
                          </tr>
                          <tr>
                              <td>#11221323</td>
                              <td>#11221323</td>
                              <td>#jerif</td>
                              <td>Entunics</td>
                              <td>Arekere</td>
                              <td>Completed</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  <section>
  
  <!--Section_end-->

  <!-- /.container-fluid -->
@endsection