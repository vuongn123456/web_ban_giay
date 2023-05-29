<?php
//views/users/register.php
?>

<!--<form action="" method="post" class="container">-->
<!--    <h2>Form đăng ký</h2>-->
<!--    <div class="form-group">-->
<!--        <label for="username">Username</label>-->
<!--        <input type="text" name="username" class="form-control"-->
<!--               id="username" >-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="password">Password</label>-->
<!--        <input type="password" name="password" class="form-control"-->
<!--               id="password" >-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="confirm_password">Nhập lại pass</label>-->
<!--        <input type="password" name="confirm_password"-->
<!--               class="form-control" id="confirm_password" >-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <input type="submit" name="submit" value="Đăng ký"-->
<!--               class="btn btn-success ">-->
<!--    </div>-->
<!--    <p class="mt-5 login-form__footer">Có tài khoản <a href="index.php?controller=user&action=login" class="text-primary">Đăng nhập </a> ngay</p>-->
<!--    <p></p>-->
<!--</form>-->


<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng ký</p>

                                <form class="mx-1 mx-md-4" action="" method="post">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="username">Tên đăng nhập</label>
                                            <input type="text" name="username" class="form-control"
                                                   id="username" >
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="password" >
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="confirm_password">Nhập lại mật khẩu</label>
                                            <input type="password" name="confirm_password"
                                                   class="form-control" id="confirm_password" >
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <input type="submit" class="btn btn-primary btn-lg" value="Đăng ký" name="submit">
                                    </div>
                                </form>
                                <p class="mt-5 login-form__footer text-center">Đã có tài khoản <a href="login.html" class="text-primary">Đăng nhập </a> ngay</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
