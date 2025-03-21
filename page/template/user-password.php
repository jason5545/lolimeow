<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//boxmoe.com===安全设置=防止直接访问主题文件
if(!defined('ABSPATH')){echo'Look your sister';exit;}

?>
        <p class="fs-6 mb-2 text-muted">請自行保管好密碼，密碼遺忘只能通過電子郵件信箱找回！請保持電子郵件信箱有效可接收郵件。</p>
                    <form class="row gy-3 needs-validation" id="passwordUpdateForm" novalidate onsubmit="return false;">
                           <div class="col-lg-7">
                              <label for="securityOldPasswordInput" class="form-label">旧密码</label>
                              <input type="password" class="form-control" id="securityOldPasswordInput" required>
                              <div class="invalid-feedback">请输入旧密码</div>
                           </div>

                           <div class="col-lg-7">
                              <label for="securityNewPasswordInput" class="form-label">新密码</label>
                              <input type="password" class="form-control" id="securityNewPasswordInput" required>
                              <div class="invalid-feedback">请输入新密码</div>
                           </div>

                           <div class="col-lg-7">
                              <label for="securityConfirmPasswordInput" class="form-label">确认新密码</label>
                              <input type="password" class="form-control" id="securityConfirmPasswordInput" required>
                              <div class="invalid-feedback">请输入确认密码</div>
                           </div>
                           <div class="col-12">
                              <button class="btn btn-primary me-2" id="passwordUpdateButton" type="submit">保存</button>
                           </div>
                        </form>
