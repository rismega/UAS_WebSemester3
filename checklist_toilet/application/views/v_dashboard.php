<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dashboard</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <?php
                                if ($this->session->userdata('role') == 'admin') {
                                ?>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3><?= $user ?><sup style="font-size: 20px"></sup></h3>
                                                <p>User</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="user" class="small-box-footer">
                                                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3><?= $toilet ?><sup style="font-size: 20px"></sup></h3>
                                                <p>Toilet</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="toilet" class="small-box-footer">
                                                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                } 
                                ?>
                    
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3><?= $checklist ?><sup style="font-size: 20px"></sup></h3>
                                            <p>Checklist</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="checklist" class="small-box-footer">
                                            Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                       
                                
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>