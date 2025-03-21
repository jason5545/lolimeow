<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//boxmoe.com===安全設定=防止直接存取主題檔案
if(!defined('ABSPATH')){echo'Look your sister';exit;}

?>

                        <div class="row gx-4">
                           <div class="col-lg-3">
                              <div class="card border-0 mb-4 mb-lg-0 bg-light-subtle">
                                 <div class="card-body py-lg-3 px-lg-4">
                                    <div class="mb-5">
                                       <h6>積分餘額</h6>
                                       <h4><?php echo boxmoe_user_money(); ?></h4>
                                    </div>
                                    <a href="?items=recharge" class="icon-link icon-link-hover text-primary">
                                       檢視儲值記錄
                                       <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                                          </path>
                                       </svg>
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="card border-0 mb-4 mb-lg-0 bg-light-subtle">
                                 <div class="card-body py-lg-3 px-lg-4">
                                    <div class="mb-5">
                                       <h6>累計消耗</h6>
                                       <h4><?php echo boxmoe_user_moneyto(); ?></h4>
                                    </div>

                                    <a href="?items=money" class="icon-link icon-link-hover text-primary">
                                       前往儲值
                                       <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                                          </path>
                                       </svg>
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="card border-0 mb-4 mb-lg-0 bg-light-subtle">
                                 <div class="card-body py-lg-3 px-lg-4">
                                    <div class="mb-5">
                                       <h6>收藏文章</h6>
                                       <h4><?php 
                                       $current_user_id = get_current_user_id();
                                       $favorites = get_user_meta($current_user_id, 'user_favorites', true);
                                       echo (!empty($favorites) && is_array($favorites)) ? count($favorites) : '0';
                                       ?>條</h4>
                                    </div>
                                    <a href="?items=collect" class="icon-link icon-link-hover text-primary">
                                       檢視收藏文章
                                       <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                                          </path>
                                       </svg>
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="card border-0 mb-4 mb-lg-0 bg-light-subtle">
                                 <div class="card-body py-lg-3 px-lg-4">
                                    <div class="mb-5">
                                       <h6>累計評論</h6>
                                       <h4><?php global $user_ID;echo get_comments('count=true&user_id='.$user_ID);?>條</h4>
                                    </div>
                                    <a href="?items=comment" class="icon-link icon-link-hover text-primary">
                                       檢視評論記錄
                                       <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                                          </path>
                                       </svg>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="mt-5 mb-5">
                           <h4 class="mb-1">更新頭像</h4>
                           <p class="mb-0 fs-7 text-muted">上傳頭像，讓您的頭像更加突出！</p>
                        </div>
                        <div class="d-flex align-items-center">
                           <div class="ms-4">
                            <form id="avatarForm">
                                <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                                <button id="uploadAvatarButton" class="btn btn-outline-primary btn-sm mb-0 ms-2">上傳頭像</button>
                                <small class="ms-3">支援 *.jpeg, *.jpg, *.png, *.gif 最大1MB</small>
                            </form>
                           </div>                          
                        </div>
                        <div class="mt-5 mb-5">
                            <h4 class="mb-1">更新資料</h4>
                            <p class="mb-0 fs-7 text-muted">補全您的資料，讓您的資料更加完整！</p>
                        </div>
                        <form class="row g-3 needs-validation" novalidate="" id="profileUpdateForm">
                           <div class="col-lg-6 col-md-12">
                              <label for="user_login" class="form-label">使用者名稱<small class="text-muted">（不可修改）</small></label>
                              <input type="text" disabled class="form-control" id="user_login" value="<?php echo $current_user->user_login; ?>" >
                           </div>
                           <div class="col-lg-6 col-md-12">
                              <label for="user_email" class="form-label">電子郵件信箱<small class="text-muted">（不可修改）</small></label>
                              <input type="text" disabled class="form-control" id="user_email" value="<?php echo $current_user->user_email; ?>" >
                           </div>
                           <div class="col-lg-6">
                              <label for="display_name" class="form-label">暱稱</label>
                              <input type="text" class="form-control input-phone" id="display_name" value="<?php echo $current_user->display_name; ?>">
                              <div class="invalid-feedback">請輸入暱稱。</div>
                           </div>
                           <div class="col-lg-6">
                              <label for="profileBiruser_urlthdayInput" class="form-label">網站</label>
                              <input type="text" class="form-control input-date" id="user_url"  value="<?php echo $current_user->user_url; ?>" >
                              <div class="invalid-feedback">請輸入網站。</div>
                           </div>
                           <div class="col-lg-12">
                              <label for="user_description" class="form-label">個人化簽名</label>
                              <textarea class="form-control" id="user_description" rows="3"><?php echo $current_user->user_description; ?></textarea>
                              <div class="invalid-feedback">請輸入個人化簽名。</div>
                           </div>
                           <div class="col-12 mt-4">
                              <button class="btn btn-primary me-2" type="submit" id="profileUpdateButton">儲存修改</button>
                           </div>
                        </form>
