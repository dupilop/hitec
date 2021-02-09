<?php 
require '../db/connect.php';

 ?>
 <div class="row">

              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Customer Registration</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <form id="form1" name="form1" method="POST" enctype="multipart/form-data">

                    <!-- Smart Wizard -->
                    <p>This is a basic form for the registration of the user.</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br />
                                              <small>Basic Description</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Normal Description</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Depth Description</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Step 4<br />
                                              <small>Step 4 description</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                     
                      <div id="step-1">
                        <div class="form-horizontal form-label-left">
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Account Number<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="c_number" name="c_number" required="required" class="form-control">
                            </div>
                            <div class="c_number_error"></div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full  Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="c_name" name="c_name" required="required" class="form-control  ">
                            </div>
                            <div class="c_name_error"></div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_dob" name="c_dob" class="date-picker form-control" required="required" type="date">
                            </div>
                            <div class="c_dob_error"></div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Occupation <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="c_occupation" name="c_occupation" required="required" class="form-control ">
                            </div>
                            <div class="c_occupation_error"></div>
                          </div>
                          <div class="form-group row">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Mobile Number<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_mobile" class="form-control col" type="text" name="c_mobile">
                            </div>
                            <div class="c_mobile_error"></div>
                          </div>
                          <div class="form-group row">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Phone Number</label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_phone" class="form-control col" type="text" name="c_phone">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="c_gender" id="gender">
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  <option value="Other">Others</option>
                                </select>
                              <!-- <div id="gender" class="btn-group" data-toggle="buttons"> -->

                                <!-- <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-secondary">
                                  <input type="radio" name="c_gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-secondary">
                                  <input type="radio" name="c_gender" value="female" class="join-btn"> Female
                                </label> -->
                              <!-- </div> -->
                            </div>
                          </div>
                          

                        </div>

                      </div>
                      <div id="step-2">
                         <div class="form-horizontal form-label-left">

                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Permanent Address <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="c_permanent_address" name="c_permanent_address" required="required" class="form-control  ">
                            </div>
                            <div class="c_permanent_address_error"></div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Current Address<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_current_address" name="c_current_address" class="form-control" required="required" type="text">
                            </div>
                            <div class="c_current_address_error"></div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Street Name 
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="c_street_name" name="c_street_name" required="required" class="form-control ">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_email" class="form-control col" type="text" name="c_email">
                            </div>
                            <div class="c_email_error"></div>
                          </div>
                          <div class="form-group row">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Office</label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_office" class="form-control col" type="text" name="c_office">
                            </div>
                          </div>
                          
                          

                        </div>
                      </div>
                      <div id="step-3">
                       <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Father's Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="c_father_name" name="c_father_name" required="required" class="form-control  ">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Mother's Name 
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="c_mother_name" name="c_mother_name" required="required" class="form-control ">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Husband/Wife
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_husorwife_name" name="c_husorwife_name" class="form-control" placeholder="Enter the name" required="required" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Grandfather's Name</label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_gfather_name" class="form-control col" type="text" name="c_gfather_name">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Father in law</label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_fatherinlaw_name" class="form-control col" placeholder="Enter the  name" type="text" name="c_fatherinlaw_name">
                            </div>
                          </div>
                          
                      </div>
                      <div id="step-4">
                        <h2 class="StepTitle">Upload</h2>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Image 
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_photo" name="c_photo" class="form-control"  type="file">
                            </div>
                          </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Citizenship Front 
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_front_citizenship" name="c_front_citizenship"  class="form-control"  type="file">
                            </div>
                          </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Citizenship Back
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="c_back_citizenship" name="c_back_citizenship" class="form-control" type="file">
                              <input id="c_created_by" name="c_created_by" value="Staff" class="form-control" type="hidden">
                            </div>
                          </div>
                        
                        <p>I accept all the above datas are correctly written.

                        </p>
                        <h2 class="txt-success">Thank You</h2>
                      </div>
                    
                    </div>
                    </form>
                    <!-- End SmartWizard Content -->
                  </div>
                </div>
              </div>
              <!----------------------->
            </div>
           
