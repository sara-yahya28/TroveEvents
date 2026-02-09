        // Arabic JavaScript for comment interactions
        document.addEventListener('DOMContentLoaded', function () {
            // Load comments when page loads
            loadComments();

            // Handle form submission
            document.getElementById('commentForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const name = document.getElementById('commentName').value.trim();
                const text = document.getElementById('commentText').value.trim();

                if (name && text) {
                    addComment(name, text);
                    document.getElementById('commentForm').reset();
                } else {
                    alert('الرجاء إدخال اسمك وتعليقك');
                }
            });

            // Like button functionality
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('like-btn') || e.target.parentElement.classList.contains('like-btn')) {
                    const likeCount = e.target.closest('.comment-likes').querySelector('.like-count');
                    likeCount.textContent = parseInt(likeCount.textContent) + 1;

                    // Visual feedback
                    const btn = e.target.classList.contains('like-btn') ? e.target : e.target.parentElement;
                    btn.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        btn.style.transform = 'scale(1)';
                    }, 200);
                }
            });
        });

        function addComment(name, text) {
            // Get existing comments or initialize empty array
            const comments = JSON.parse(localStorage.getItem('comments')) || [];

            // Add new comment
            const newComment = {
                id: Date.now(), // Unique ID based on timestamp
                name: name,
                text: text,
                date: new Date().toLocaleString('ar-EG'),
                likes: 0
            };

            comments.unshift(newComment); // Add to beginning of array (newest first)

            // Save to localStorage
            localStorage.setItem('comments', JSON.stringify(comments));

            // Refresh comments display
            loadComments();
        }

        function loadComments() {
            const comments = JSON.parse(localStorage.getItem('comments')) || [];
            const commentList = document.querySelector('.comment-list');

            // Keep the first two default comments
            const defaultComments = commentList.innerHTML;

            // Clear existing comments (we'll re-add the default ones)
            commentList.innerHTML = defaultComments;

            // Add user comments
            comments.forEach(comment => {
                const commentItem = document.createElement('li');
                commentItem.className = 'comment-item';
                commentItem.style = 'background: white; border-radius: 15px; padding: 15px; margin-bottom: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);';

                commentItem.innerHTML = `
                    <div class="comment">
                        <div class="comment-header" style="display: flex; align-items: center; margin-bottom: 0.8rem; flex-direction: row-reverse;">
                            <img src="user-default.jpg" alt="مستخدم" style="width: 40px; height: 40px; border-radius: 50%; margin-left: 10px; margin-right: 0;">
                            <div style="text-align: right;">
                                <h4 class="comment-name" style="color: #333; margin: 0; font-size: 1.4rem;">${comment.name}</h4>
                                <span class="comment-log" style="color: #7a7a7a; font-size: 1.1rem;">${comment.date}</span>
                            </div>
                        </div>
                        <div class="comment-body" style="margin-bottom: 1rem; text-align: right;">
                            <p style="color: #555; line-height: 1.5; font-size: 1.3rem;">${comment.text}</p>
                        </div>
                        <div class="comment-footer" style="display: flex; align-items: center; justify-content: flex-end;">
                            <a href="#!" class="comment-action" style="color: #bc87b8; margin-left: 10px; margin-right: 0; text-decoration: none; font-size: 1.2rem;">الإبلاغ</a>
                            <a href="#!" class="comment-action" style="color: #bc87b8; text-decoration: none; font-size: 1.2rem;">رد</a>
                            <div class="comment-likes" style="display: flex; align-items: center; margin-right: 15px; margin-left: 0;">
                                <span class="like-count" style="font-weight: 600; margin-left: 0.5rem; margin-right: 0; font-size: 1.2rem;">${comment.likes}</span>
                                <button class="like-btn" style="background: none; border: none; cursor: pointer;">
                                    <img src="https://rvs-comment-module.vercel.app/Assets/Up.svg" alt="أعجبني" style="width: 16px;">
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                // Insert new comment after the default comments
                commentList.appendChild(commentItem);
            });
        }