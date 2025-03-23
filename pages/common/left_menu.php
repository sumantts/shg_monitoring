<style>
  .nav-link{
    height: 45px !important;
  }
</style>

<div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
             <!-- <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="assets/images/mohila-bikash-small.png" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?=$_SESSION["StfNm"]?></p>                  
                </div>
              </a>
            </li>  -->
            <li class="nav-item nav-category" style="font-size: 16px;font-weight: bold;color: #fff;"><?=$_SESSION["StfNm"]?></li>
            
            <li class="nav-item <?php if($p == 'dashboard' || $p == 'dashboard-more'){?>active<?php } ?>">
              <a class="nav-link" href="?p=dashboard">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'group-list'){?>active<?php } ?>">
              <a class="nav-link" href="?p=group-list">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Group List</span>
              </a>
            </li>
            <?php if($_SESSION["StfId"] == 99){?>
            <!-- <li class="nav-item <?php if($p == 'group-upload' || $p == 'member-upload' || $p == 'loan-upload'){?>active<?php } ?>">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Upload</span>
                <i class="menu-arrow"></i>
              </a>
              <div <?php if($p == 'group-upload' || $p == 'member-upload' || $p == 'loan-upload'){?>class="collapse show"<?php }else{?>class="collapse"<?php } ?> id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="?p=group-upload">Group Upload</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?p=member-upload">Member Upload</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?p=loan-upload">Loan Upload</a>
                  </li>
                </ul>
              </div>
            </li> -->
            <li class="nav-item <?php if($p == 'group-upload'){?>active<?php } ?>">
              <a class="nav-link" href="?p=group-upload">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Group Upload</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'member-upload'){?>active<?php } ?>">
              <a class="nav-link" href="?p=member-upload">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Member Upload</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'loan-upload'){?>active<?php } ?>">
              <a class="nav-link" href="?p=loan-upload">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Loan Upload</span>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item <?php if($p == 'group-opening-data'){?>active<?php } ?>">
              <a class="nav-link" href="?p=group-opening-data">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title"> Group Opening Data</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'opening-data'){?>active<?php } ?>">
              <a class="nav-link" href="?p=opening-data">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Member Opening Data</span>
              </a>
            </li>


            <li class="nav-item <?php if($p == 'meeting-data' || $p == 'meeting-data-report'){?>active<?php } ?>">
              <a class="nav-link" href="?p=meeting-data">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Meeting Data</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'sansad-meeting'){?>active<?php } ?>">
              <a class="nav-link" href="?p=sansad-meeting">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Sansad Meeting</span>
              </a>
            </li>
            <?php if($_SESSION["StfId"] == 99){?>
            <li class="nav-item <?php if($p == 'update-data'){?>active<?php } ?>">
              <a class="nav-link" href="?p=update-data">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Update Data</span>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item <?php if($p == 'voucher-entry'){?>active<?php } ?>">
              <a class="nav-link" href="?p=voucher-entry">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Voucher Entry</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'social-activity'){?>active<?php } ?>">
              <a class="nav-link" href="?p=social-activity">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Social Activity</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'livelihood-activity'){?>active<?php } ?>">
              <a class="nav-link" href="?p=livelihood-activity">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Livelihood Activity</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'cash-book'){?>active<?php } ?>">
              <a class="nav-link" href="?p=cash-book">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Cash Book</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'link-group'){?>active<?php } ?>">
              <a class="nav-link" href="?p=link-group">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Link Group</span>
              </a>
            </li>

            <li class="nav-item <?php if($p == 'link-member'){?>active<?php } ?>">
              <a class="nav-link" href="?p=link-member">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title"> Link Member</span>
              </a>
            </li>

            <li class="nav-item <?php if($p == 'member-transfer'){?>active<?php } ?>">
              <a class="nav-link" href="?p=member-transfer">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Member Transfer</span>
              </a>
            </li>
            
            <?php if($_SESSION["StfId"] == 99){?>
            <li class="nav-item <?php if($p == 'member-update'){?>active<?php } ?>">
              <a class="nav-link" href="?p=member-update">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title"> Member Update</span>
              </a>
            </li>

            <li class="nav-item <?php if($p == 'collection-delete'){?>active<?php } ?>">
              <a class="nav-link" href="?p=collection-delete">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Collection Delete</span>
              </a>
            </li>
            
            <li class="nav-item <?php if($p == 'data-export'){?>active<?php } ?>">
              <a class="nav-link" href="?p=data-export">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Data Export</span>
              </a>
            </li>
            <?php } ?>

            
            <!-- <li class="nav-item <?php if($p == 'member-list' || $p == 'attendance-report' || $p == 'savings-ledger-report' || $p == 'loan-register-report'){?>active<?php } ?>">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
              </a>
              <div <?php if($p == 'member-list' || $p == 'attendance-report' || $p == 'savings-ledger-report' || $p == 'loan-register-report'){?>class="collapse show"<?php }else{?>class="collapse"<?php } ?> id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="?p=member-list">Member List</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?p=attendance-report">Attendance Report</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?p=savings-ledger-report">Savings Ledger Report</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?p=loan-register-report">Loan Register Report</a>
                  </li>
                </ul>
              </div>
            </li> -->
            <li class="nav-item <?php if($p == 'member-list'){?>active<?php } ?>">
              <a class="nav-link" href="?p=member-list">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Member List</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'attendance-report'){?>active<?php } ?>">
              <a class="nav-link" href="?p=attendance-report">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Attendance Report</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'savings-ledger-report'){?>active<?php } ?>">
              <a class="nav-link" href="?p=savings-ledger-report">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Savings Ledger Report</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'loan-register-report'){?>active<?php } ?>">
              <a class="nav-link" href="?p=loan-register-report">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Loan Register Report</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'incentive-report'){?>active<?php } ?>">
              <a class="nav-link" href="?p=incentive-report">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Incentive Report</span>
              </a>
            </li>
            
            <?php if($_SESSION["StfId"] == 99){?>
            <li class="nav-item">
              <a class="nav-link" target="_blank" href="?p=backup">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Backup</span>
              </a>
            </li>
            <?php } ?>

            <!-- <li class="nav-item <?php if($p == 'change-password'){?>active<?php } ?>">
              <a class="nav-link" href="?p=change-password">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Change Password</span>
              </a>
            </li> -->

            <li class="nav-item">
              <a class="nav-link" href="?p=login&out=ok">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Sign Out</span>
              </a>
            </li>
          </ul>
        </nav>