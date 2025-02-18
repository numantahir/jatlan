<style>
        @font-face{
            font-family:'GothamBlack','GothamBook';
            src:url("<?php echo SITE_URL.'appform/';?>fonts/Gotham-Black.ttf");
            src:url("<?php echo SITE_URL.'appform/';?>fonts/Gotham-Book.ttf");
        }
        .compname{
            float:left;
			text-align: left
        }        
        .compname h1{
            font-family:GothamBlack;
            font-size:20px;
            font-weight:bold;
            margin-bottom:0px;
        }
        .compname span{
            font-family:'Gotham Book';
            font-size:20px;
        }
        .compname h5{
            margin:0px;
            padding:0px;
            font-size:10px;
            font-family:'Gotham Book';
        }
        .compname h3{
            margin-top:5px;
            font-size:13px;
            font-family:'Gotham Book';
        }

        .compname h3 span{
            padding-left:200px;
            font-size:13px;
        }
        .complogo img{
            float:right;
            width:180px;
            height:auto;
            margin-top:10px;
        }
        .comptable{
            display:table;
            /*width:600px;*/
            width:100%;
			text-align: left;
            border:solid 2px #51BD9A;      
            position: relative;
            color:white;
            margin-top:10px;
            border-top:0px; 
        }
        .comptable img{
            /*width:600px;*/
            width:100%;
            height:20px;
        }
        .comptable h3{
            position: absolute;
            top:7px;
            left:40px;
            font-size:13px;
            font-family:GothamBlack;
            margin:0px;
        }
		
		.comptable table{
			color:#000 !important;
		}

        .h3prop{
            font-family:GothamBlack;
            font-size:12px;
            margin:0 20px 0 10px;
            color:black;
            letter-spacing:0.5px;
        }
        .h3prop2{
            font-family:'Gotham Book';
            font-size:14px;
            margin:0 20px 0 10px;
            color:black;
            letter-spacing:0.5px;
        }
        .rowprop{
            width:100%;
            margin-right:0px;
        }
        .spanprop{
            font-family:'Gotham Book';
            font-size:12px;
            margin:10px 0px 5px 0px;
            color:black;
            letter-spacing:0px;
        }

        .checkboxprop{
            align-items:baseline;
            font-family:'Gotham Book';
            font-size:14px;
            margin:10px 20px;
        }

        /*input[type='checkbox']{
                border: 1px solid #FFFFFF;
                background: transparent; 
        }*/
        .tempuncheck{
            background:transparent ;
            background-position: center;
            border:solid 2px #000;
        }
        .tempcheck{
            background-color:black ;
            background-position: center;
            border:solid 2px #000;
        }
        .block{
            background:transparent ;
            background-position: center;
            border:solid 1px #000;
            padding:0px 4px;
            margin-right:-1px;
        }
	td.cnic .block {
    float: left;
    width: 20px;
    height: 22px;
}

        .termblock{
            display:table;
            /*width:600px;*/
            width:800px;

            position: relative;
            margin-top:10px;
			text-align: left
        }
	.h3prop2 td.cnic label {
    color: #000;
    float: left;
    margin: 0 10px 0 0px;
}
        .footerprop{
            width:100% !important;
            height:26px;
            margin-top:10px;
            bottom:0px;

        }
        section{
            margin-bottom:18px;
        }
        strong{
            font-family:GothamMedium;
            font-size:14px;
        }
	.card img {
    /*width: 100%;*/
    height: auto;
}
	.complogo img{
		width: 180px
	}
	table.user-table {
    width: 100%;
}
	table.signature {
    width: 100%;
}
	td.sign {
    width: 32%;
    margin: 0 11px 0 0px;
    display: inline-block;
}
    </style>
<div>
        <div>
            <div class="compname">
                <h1>Qayad <span>(Pvt) Ltd</span></h1>
                <h5>Booking Application Form (Non-Refundable)</h5>
                <h3>CUSTOMER COPY  <span> APP NO:&nbsp; N/A</span></h3>
            </div>
            <div class="complogo">
                <img src="<?php echo SITE_URL.'appform/';?>images/mlogo.png" />
            </div>
        </div>
        <section class="comptable">
            <img src="<?php echo SITE_URL.'appform/';?>images/tabletop.jpg" />
            <h3>REGISTRATION DETAIL</h3>
            <div class="h3prop">
                REGISTRATION NUMBER
                <span class="spanprop">(as per submitted registration form):&nbsp; QYD-FEB18-001</span>
            </div>
            <div class="h3prop">
                REGISTRATION PROJECT:
                <?php if($af_pri == 1){?>
                <label class="checkboxprop"><span class="<?php echo MenuActivation(1, $af_pri, 3);?>">&nbsp; &nbsp;</span> Qayad Hotel</label>
                <?php } elseif($af_pri == 2){?>
                <label class="checkboxprop"><span class="<?php echo MenuActivation(2, $af_pri, 3);?>">&nbsp; &nbsp;</span> Qayad Mall</label>
                <?php } elseif($af_pri == 2){?>
                <label class="checkboxprop"><span class="<?php echo MenuActivation(3, $af_pri, 3);?>">&nbsp; &nbsp;</span> Qayad Theme Park</label>
                <?php } ?>
            </div>
            <div class="h3prop">
                ORGINAL REGISTRATION STATUS:
                <?php if($_SESSION['InfoDetail']["registration_type"] == 1){?>
                <label class="checkboxprop"><span class="<?php echo MenuActivation(1, $_SESSION['InfoDetail']["registration_type"], 3);?>">&nbsp; &nbsp;</span> First Alottee</label>
                <?php } elseif($_SESSION['InfoDetail']["registration_type"] == 2){?>
                <label class="checkboxprop"><span class="<?php echo MenuActivation(2, $_SESSION['InfoDetail']["registration_type"], 3);?>">&nbsp; &nbsp;</span>Transfer Certificate</label>
                <?php } elseif($_SESSION['InfoDetail']["registration_type"] == 3){?>
                <label class="checkboxprop"><span class="<?php echo MenuActivation(3, $_SESSION['InfoDetail']["registration_type"], 3);?>">&nbsp; &nbsp;</span>Open Certificate</label>
                <?php } ?>
            </div>
            <div class="h3prop">
                FLOOR NAME:
				<label class="checkboxprop"><?php echo $FloorNumber['floor_name'];?></label>
                
            </div>
        </section>

        <section class="comptable">
            <img src="<?php echo SITE_URL.'appform/';?>images/tabletop.jpg" />
            <h3>PROPERTY SECTION</h3>
            <div class="h3prop">
                <label class="checkboxprop"><?php echo $PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft]';?></label>
            </div>
        </section>

        <section class="comptable">
            <img src="<?php echo SITE_URL.'appform/';?>images/tabletop.jpg" />
            <h3>PERSONAL INFORMATION</h3>
            <div class="h3prop2">
                <table style="text-align:left;">
                    <tr>
                        <td style="width:380px;"><strong>Name of Applicant:</strong>&nbsp; <?php echo $_SESSION['InfoDetail']["customer_fname"] . ' ' .$_SESSION['InfoDetail']["customer_lname"];?> </td>
                        <td><strong>S/O, D/O,W/O:</strong> &nbsp; <?php echo $_SESSION['InfoDetail']["customer_father"];?></td>
                    </tr>
                    <tr><td><br /></td></tr>
                    <tr>
                        <td class="cnic">
                            <label><strong>CNIC:</strong></label> &nbsp;
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],0,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],1,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],2,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],3,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],4,1);?></span>
                            <span class="block">-</span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],5,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],6,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],7,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],8,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],9,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],10,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],11,1);?></span>
                            <span class="block">-</span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_cnic"],12,1);?></span>
                        </td>
                        <td class="cnic">
                            <label><strong>Passport No:</strong></label>&nbsp;
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],0,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],1,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],2,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],3,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],4,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],5,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],6,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],7,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["customer_passport"],8,1);?></span>
                        </td>
                    </tr>
                    <!--<tr>
                    <td><strong>Name of Applicant :</strong> <u>Dummy Dummy Dummy</u></td>
                    <td><strong>S/O D/O W/O :</strong> <u>Dummy Dummy Dummy</u></td>
                </tr>
                <tr>
                    <td><strong>CNIC :</strong> <u>12345-6789011-1</u></td>
                    <td><strong>Passport No :</strong> <u>12345678</u></td>
                </tr>-->
                </table>
                <br />
                <table class="user-table" style="text-align:left;">
                    <tr>
                        <td class="user-detail" style="width:380px;"><strong>Mailing Address:</strong>&nbsp; <?php echo $_SESSION['InfoDetail']["customer_c_address"];?></td>
                        <td class="user-pic" style="height:120px; width:88px;border:solid 1px #808080;" rowspan="3"><center>
                        <?php if($CustomerProfileImageName !=''){?>
                    <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CustomerProfileImageName);?>" class="customer_profile_img">
                    <?php } else { ?>
                    <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.$_SESSION['InfoDetail']['applicant_profile_image'];?>" class="customer_profile_img">
                    <?php } ?>
                        </center></td>
                    </tr>
                    <tr>
                        <td><strong>Permenant Address:</strong> &nbsp; <?php echo $_SESSION['InfoDetail']["customer_p_address"];?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong> &nbsp; <?php echo $_SESSION['InfoDetail']["customer_email"];?></td>
                    </tr>
                </table>
                <br />
                <table style="text-align:left;">
                    <tr>
                        <td style="width:266px;"><strong>Phone No:</strong>&nbsp; <?php echo $_SESSION['InfoDetail']["customer_phone"];?></td>
                        <td style="width:266px;"><strong>Res:</strong>&nbsp; <?php echo $_SESSION['InfoDetail']["customer_mobile"];?></td>
                        <td style="width:266px;"><strong>Mobile:</strong>&nbsp; <?php echo $_SESSION['InfoDetail']["customer_mobile_2"];?></td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="comptable">
            <img src="<?php echo SITE_URL.'appform/';?>images/tabletop.jpg" />
            <h3>NOMINEE INFORMATION</h3>
            <div class="h3prop2">
                <table style="text-align:left;">
                    <tr>
                        <td style="width:380px;"><strong>Nominee Name:</strong>&nbsp; <?php echo $_SESSION['InfoDetail']["n_customer_fname"].' '.$_SESSION['InfoDetail']["n_customer_lname"];?></td>
                        <td><strong> S/O:</strong> &nbsp; <?php echo $_SESSION['InfoDetail']["n_customer_father"];?></td>
                    </tr>
                    <tr><td colspan="2"><br /></td></tr>
                    <tr>
                        <td class="cnic">
                            <label><strong>CNIC:</strong></label> &nbsp;
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],0,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],1,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],2,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],3,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],4,1);?></span>
                            <span class="block">-</span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],5,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],6,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],7,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],8,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],9,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],10,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],11,1);?></span>
                            <span class="block">-</span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_cnic"],12,1);?></span>
                            <br />
                        </td>
                        <!-- 61101-0588104-7 -->
                        <td class="cnic">
                            <label><strong>Passport No:</strong></label>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],0,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],1,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],2,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],3,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],4,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],5,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],6,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],7,1);?></span>
                            <span class="block"><?php echo substr($_SESSION['InfoDetail']["n_customer_passport"],8,1);?></span>
                        </td>
                    </tr>
                </table>
                <br />
                <table style="text-align:left;">
                    <tr>
                        <td><strong>Relationship with Applicant:</strong> &nbsp; <?php echo $_SESSION['InfoDetail']["customer_relation_name"];?></td>
                    </tr>
                    <tr><td><br /></td></tr>
                    <tr>
                        <td><strong>Mailing Address:</strong>&nbsp;<?php echo $_SESSION['InfoDetail']["n_customer_c_address"];?></td>
                    </tr>
                </table>
            </div>
        </section>
        
        
        
        
        
        
        
        <?php if(!empty($_SESSION['JointAplicInfo'])){ for($j=1;$j<=count($_SESSION['JointAplicInfo']) / 2;$j++){ // Start For Loop?>
        <section class="comptable"> <img src="<?php echo SITE_URL.'appform/';?>images/tabletop.jpg" />
    <h3>Joint Applicant - <?php echo $j;?></h3>
    <div class="h3prop2">
      <table style="text-align:left;">
        <tr>
          <td style="width:380px;" class="h3prop">Name of Applicant: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_fname'].' '.$_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_lname'];?></td>
          <td>S/O, D/O,W/O: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_father'];?></td>
        </tr>
        <tr>
          <td><br /></td>
        </tr>
        <tr>
          <td class="cnic"><label><strong>CNIC:</strong></label>
            &nbsp; 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],0,1);?></span>
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],1,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],2,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],3,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],4,1);?></span> 
            <span class="block">-</span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],5,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],6,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],7,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],8,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],9,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],10,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],11,1);?></span> 
            <span class="block">-</span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic'],12,1);?></span></td>
          <td class="cnic"><label><strong>Passport No:</strong></label>
            &nbsp; 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],0,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],1,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],2,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],3,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],4,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],5,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],6,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],7,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport'],8,1);?></span>
           </td>
        </tr>
      </table>
      <br />
      <table class="user-table" style="text-align:left;">
        <tr>
          <td class="user-detail" style="width:380px;">Mailing Address: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_c_address'];?></td>
          <td class="user-pic" style="height:120px; width:99px;border:solid 1px #808080;" rowspan="3"><center>
              <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.$_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_profile_image'];?>" class="customer_profile_img">
            </center></td>
        </tr>
        <tr>
          <td>Permenant Address: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_p_address'];?></td>
        </tr>
        <tr>
          <td>Email: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_email'];?></td>
        </tr>
      </table>
      <br />
      <table style="text-align:left;">
        <tr>
          <td style="width:266px;">Phone No: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_c_phone'];?></td>
          <td style="width:266px;">Res: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_c_mobile'];?></td>
          <td style="width:266px;">Mobile: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_c_mobile_2'];?></td>
        </tr>
      </table>
    </div>
  </section>
  
 <section class="comptable"> <img src="<?php echo SITE_URL.'appform/';?>images/tabletop.jpg" />
    <h3>Joint Nominee - <?php echo $j;?></h3>
    <div class="h3prop2">
      <table style="text-align:left;">
        <tr>
          <td style="width:450px;">Nominee Name: <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_fname'].' '.$_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_lname'];?></td>
          <td><strong> S/O:</strong> &nbsp; <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_father'];?></td>
        </tr>
        <tr>
          <td colspan="2"><br /></td>
        </tr>
        <tr>
          <td class="cnic"><label><strong>CNIC:</strong></label>
            &nbsp; 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],0,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],1,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],2,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],3,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],4,1);?></span> 
            <span class="block">-</span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],5,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],6,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],7,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],8,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],9,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],10,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],11,1);?></span> 
            <span class="block">-</span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic'],12,1);?></span> <br /></td>
          <!-- 61101-0588104-7 -->
          <td class="cnic"><label><strong>Passport No:</strong></label>
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],0,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],1,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],2,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],3,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],4,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],5,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],6,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],7,1);?></span> 
            <span class="block"><?php echo substr($_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport'],8,1);?></span></td>
        </tr>
      </table>
      <br />
      <table style="text-align:left;">
        <tr>
          <td><strong>Relationship with Applicant:</strong> &nbsp; <?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_relation_name'];?></td>
        </tr>
        <tr>
          <td><br /></td>
        </tr>
        <tr>
          <td><strong>Mailing Address:</strong>&nbsp;<?php echo $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_c_address'];?></td>
        </tr>
      </table>
    </div>
  </section>

		<?php } }
		
/////////////////////////////////////////////////////////////////////////////////////////////////////
//echo trim(DecData($_SESSION['InfoDetail']["pi"], 1, $objBF));
//die();
$objQayadProertyPaymentDetail = new Qayadproperty;
$objQayadProertyPaymentDetail->setProperty("property_id", trim(DecData($_SESSION['InfoDetail']["pi"], 1, $objBF)));
$objQayadProertyPaymentDetail->setProperty("isActive", 1);
$objQayadProertyPaymentDetail->lstPropertyPaymentDetail();
$PropertyPaymentPlan = $objQayadProertyPaymentDetail->dbFetchArray(1);

$DownPayment = $PropertyPaymentPlan["down_payment"];
$InstalmentDetail = $PropertyPaymentPlan["instalment_per_month"];
$TotalAmountCal = $InstalmentDetail * 10 + $DownPayment;
if($_SESSION['InfoDetail']["customer_p_address"] != ""){
$AppRegStartDate = $_SESSION['InfoDetail']["applic_reg_date"];
} else {
$AppRegStartDate = date("Y-m-d");	
}
?>
  
  
  <div style="margin:30px 0px;"> <b>Total Cost of Unit</b>:<u><?php echo Numberformt($TotalAmountCal);?>/-</u> </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
        <section class="termblock">
            <div style="font-family:GothamBlack; font-size:14px;">Document to be attached with the form:</div>
            <div style="font-family:'Gotham Book'; font-size:10px; margin-top:5px;">
                1- Two Recent Passport Size Photographs.  2- Copy of Applicant CNIC.  3- Copy of Nominee CNIC.
            </div>
            <div style="font-family:'Gotham Book'; font-size:10px; margin-top:5px;">
                4- Original Registration Form(Customer Copy) / Original Registration Transfer Certificate / Original Registration Open Certificate.
            </div>
        </section>
        <section style="width:100%; font-family:'Gotham Book'; font-size:12px; margin-top:50px; text-align:center;">
            <table class="signature">
              <tr>
                <td class="sign">&nbsp;</td>
                <td class="sign">&nbsp;</td>
                <td class="sign">&nbsp;</td>
              </tr>
              <tr>
                <td class="sign" style="border-top:solid 1px #000;"> BOOKING OFFICER & DATE</td>
                <td class="sign" style="border-top:solid 1px #000;"> MANAGER</td>
                <td class="sign" style="border-top:solid 1px #000;"> APPLICANT's SIGNATURE</td>
              </tr>
            </table>
        </section>
    </div>
    <img src="<?php echo SITE_URL.'appform/';?>images/footer.jpg" class="footerprop" />