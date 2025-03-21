document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('commentform');
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const messageArea = document.querySelector('.message-content');
            const submitBtn = this.querySelector('.submit-btn');
            const submitBtnIcon = submitBtn.querySelector('i');
            
            // 更改按鈕狀態為提交中
            submitBtn.disabled = true;
            submitBtnIcon.className = 'fa fa-spinner fa-spin';
            submitBtn.innerHTML = `${submitBtnIcon.outerHTML} 正在發表...`;

            // 新增AJAX請求參數
            formData.append('action', 'ajax_comment');
            formData.append('security', document.querySelector('#comment_nonce_field').value);

            fetch(ajax_object.ajaxurl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // 清空輸入框
                    this.querySelector('textarea').value = '';
                    
                    // 更新使用者資訊顯示
                    const userNameElement = document.querySelector('.user-info .user-name');
                    const userEmailElement = document.querySelector('.user-info .user-email');
                    if (userNameElement && !ajax_object .is_user_logged_in) {
                        userNameElement.textContent = formData.get('author');
                    }
                    if (userEmailElement && !ajax_object .is_user_logged_in) {
                        userEmailElement.textContent = formData.get('email');
                    }
                    
                    // 取得新留言容器
                    const commentNew = document.querySelector('.comment-new');
                    const newContent = commentNew.querySelector('.new-content');
                    
                    // 插入新留言
                    const newComment = createCommentElement(data.data.comment);
                    newContent.insertAdjacentElement('afterbegin', newComment);
                    
                    // 顯示新留言容器並新增動畫效果
                    commentNew.style.display = 'block';
                    void commentNew.offsetWidth;
                    commentNew.classList.add('show');
                    
                    // 初始化新留言中的懶加載圖片
                    const lazyImages = newComment.querySelectorAll('img.lazy');
                    lazyImages.forEach(img => {
                        const imageObserver = new IntersectionObserver((entries, observer) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    img.src = img.dataset.src;
                                    img.classList.remove('lazy');
                                    observer.unobserve(img);
                                }
                            });
                        });
                        imageObserver.observe(img);
                    });
                    
                    // 更新留言計數
                    updateCommentCount();
                    
                    showMessage(data.data.message || '留言提交成功！', 'success');
                } else {
                    showMessage(data.data || '提交失敗，請檢查輸入！', 'error');
                }
            })
            .catch(error => {
                console.error('留言提交錯誤:', error);
                showMessage('網路錯誤，請重試！', 'error');
            })
            .finally(() => {
                // 恢復按鈕狀態
                submitBtn.disabled = false;
                submitBtnIcon.className = 'fa fa-paper-plane';
                submitBtn.innerHTML = `${submitBtnIcon.outerHTML} 發表留言`;
            });
        });
    }

    // 建立留言元素
    function createCommentElement(comment) {
        // 使用臨時div包裹處理空格問題
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = comment.trim();
        return tempDiv.firstElementChild;
    }

    // 更新留言數量
    function updateCommentCount() {
        const countElement = document.querySelector('.post-comments h2');
        const currentCount = parseInt(countElement.textContent.match(/\d+/)[0]);
        countElement.textContent = countElement.textContent.replace(/\d+/, currentCount + 1);
    }

    // 回覆按鈕處理
    document.body.addEventListener('click', function(e) {
        if (e.target.closest('.comment-reply-link')) {
            e.preventDefault();
            const replyLink = e.target.closest('.comment-reply-link');
            const commentId = replyLink.dataset.commentid;
            document.querySelector('#comment_parent').value = commentId;
            document.getElementById('cancel-comment-reply-link').style.display = 'inline';
        }
    });
});

// 留言工具列功能初始化
function initCommentToolbar() {
    const commentTextarea = document.querySelector('#comment');
    const emojiBtn = document.querySelector('.emoji-btn');
    const uploadBtn = document.querySelector('.upload-btn');
    const codeBtn = document.querySelector('.code-btn');
    const emojiPanel = document.querySelector('.emoji-panel');
    const codePanel = document.querySelector('.code-panel');
    const uploadInput = document.querySelector('.upload-input');
    
    if(emojiBtn && emojiPanel) {
        emojiBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            // 新增元素存在性檢查
            const isVisible = emojiPanel && emojiPanel.style.display === 'block';
            if(emojiPanel) {
                emojiPanel.style.display = isVisible ? 'none' : 'block';
                codePanel && (codePanel.style.display = 'none');
            }
            
            if(emojiPanel && !isVisible) {
                const firstTab = emojiPanel.querySelector('.emoji-tabs span');
                if(firstTab) {
                    firstTab.click();
                }
            }
        });

        const emojis = {
            emoji: [
                '😀','😁','😂','🤣','😃','😄',
                '😅','😆','😉','😊','😋','😎',
                '😍','🥰','😘','😗','😙','😚',
                '😛','😝','🤗','🤔','🤨','😐',
                '😑','😶','🙄','😏','😣','😥',
                '😮','🤤','😴','😪','😵','😵',
                '😵','🤯','🤠','🤡','🤥','🤫',
                '🤔','🤨','😐','😑','😶','🙄',
            ],
            custom: ['(⌒▽⌒)', '(￣▽￣)', '(=・ω・=)', '(｀・ω・´)', 
                '(〜￣△￣)〜', '(･∀･)', '(°∀°)ﾉ', '(￣3￣)', '╮(￣▽￣)╭',
                '(*>.<*)', '( ˃̶͈◡˂̶͈ ) hi!','⚆_⚆？', '⚆_⚆', '(｡•ˇ‸ˇ•｡)'
            ]        
        };

        const emojiContent = emojiPanel.querySelector('.emoji-content');
        const emojiTabs = emojiPanel.querySelectorAll('.emoji-tabs span');
                emojiTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const type = tab.dataset.tab;
                emojiTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                emojiContent.innerHTML = '';
                emojis[type].forEach(emoji => {
                    const span = document.createElement('span');
                    span.textContent = emoji;
                    span.addEventListener('click', () => {
                        insertAtBoxmoe(commentTextarea, emoji);
                        emojiPanel.style.display = 'none';
                    });
                    emojiContent.appendChild(span);
                });
            });
            
            // 預設啟用emoji標籤
            if(tab.classList.contains('active')) {
                tab.click();
            }
        });
    }

    // 圖片上傳功能
    if(uploadBtn && uploadInput) {
        uploadBtn.addEventListener('click', () => {
            uploadInput.click();
        });

        uploadInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if(file) {
                if(file.size > 2 * 1024 * 1024) { // 2MB限制
                    showMessage('圖片大小不能超過2MB', 'error');
                    return;
                }
                
                try {
                    const imgUrl = await uploadImage(file);
                    insertAtBoxmoe(commentTextarea, `![${file.name}](${imgUrl})`);
                } catch(err) {
                    showMessage('圖片上傳失敗', 'error');
                }
            }
        });
    }

    // pl程式碼醒目提示插入功能
    if(codeBtn && codePanel) {
        const closeBtn = codePanel.querySelector('.close-btn');
        const insertBtn = codePanel.querySelector('.insert-code-btn');
        const codeInput = codePanel.querySelector('.code-input');
        const langSelect = codePanel.querySelector('.code-language');

        // 初始化程式碼面板位置
        codePanel.style.display = 'none';
        
        codeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            codePanel.style.display = codePanel.style.display === 'none' ? 'block' : 'none';
            emojiPanel && (emojiPanel.style.display = 'none');
            if(codePanel.style.display === 'block') {
                codeInput.focus();
            }
        });

        closeBtn.addEventListener('click', () => {
            codePanel.style.display = 'none';
        });

        insertBtn.addEventListener('click', () => {
            const code = codeInput.value.trim();
            if(code) {
                // 修改為WordPress相容的pre+code標籤格式
                const codeBlock = `\n<pre><code class="language-">\n${code}\n</code></pre>\n`;
                insertAtBoxmoe(commentTextarea, codeBlock);
                codeInput.value = '';
                codePanel.style.display = 'none';
            }
        });

        // Enter鍵提交支援
        codeInput.addEventListener('keydown', (e) => {
            if(e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                insertBtn.click();
            }
        });
    }

    document.addEventListener('click', (e) => {
        // 新增元素存在性檢查
        if(emojiPanel && emojiBtn) {
            if(!emojiPanel.contains(e.target) && !emojiBtn.contains(e.target)) {
                emojiPanel.style.display = 'none';
            }
        }
        if(codePanel && codeBtn) {
            if(!codePanel.contains(e.target) && !codeBtn.contains(e.target)) {
                codePanel.style.display = 'none';
            }
        }
    });
}
// 留言回覆初始化
function initCommentReply() {
    const commentForm = document.getElementById('respond');
    const cancelReply = document.getElementById('cancel-comment-reply-link');
    const commentList = document.querySelector('.comments-list');
    if (!commentForm || !cancelReply || !commentList) return;
    let originalPosition = null; 
    document.querySelectorAll('.comment-reply-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            if (!commentForm) return;        
            if (!originalPosition) {
                originalPosition = commentForm.parentNode;
            }
            const commentItem = link.closest('.comment-item');
            const commentContent = commentItem?.querySelector('.comment-content');               
            if (!commentContent) return;         
            cancelReply.style.display = 'inline-block';
            commentContent.appendChild(commentForm);
            commentForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
            commentForm.querySelector('#comment')?.focus();
        });
    });
    if(cancelReply) {
        cancelReply.addEventListener('click', (e) => {
            e.preventDefault();
            cancelReply.style.display = 'none';
            if (originalPosition) {
                originalPosition.appendChild(commentForm);
            }
            commentForm?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    }
}

// 留言訊息初始化
function showMessage(message, type = 'success') {
    const messageEl = document.querySelector('.comment-message');
    const contentEl = messageEl.querySelector('.message-content');
    
    messageEl.className = 'comment-message ' + type;
    contentEl.textContent = message;
    messageEl.classList.add('show');

    setTimeout(() => {
        messageEl.classList.remove('show');
    }, 5000);
}

//編輯器輔助函數
function insertAtBoxmoe(textarea, text) {
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const value = textarea.value;
    
    textarea.value = value.substring(0, start) + text + value.substring(end);
    textarea.selectionStart = textarea.selectionEnd = start + text.length;
    textarea.focus();
}

// 留言列表顯示/隱藏功能初始化
function initCommentsToggle() {
    const toggle = document.querySelector('.comments-toggle');
    const commentsList = document.querySelector('.comments-list');
    
    if (!toggle || !commentsList) return;
    
    // 從localStorage取得狀態
    const isOpen = localStorage.getItem('commentsListOpen') === 'true';
    
    // 初始化狀態
    if (isOpen) {
        toggle.classList.add('active');
        toggle.querySelector('span').textContent = '收起留言列表';
        commentsList.classList.add('show');
    }
    
    toggle.addEventListener('click', () => {
        const isActive = toggle.classList.toggle('active');
        toggle.querySelector('span').textContent = isActive ? '收起留言列表' : '檢視留言列表';
        commentsList.classList.toggle('show');
        
        // 儲存狀態到localStorage
        localStorage.setItem('commentsListOpen', isActive);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    initCommentReply();
    initCommentToolbar();
    initCommentsToggle();
});