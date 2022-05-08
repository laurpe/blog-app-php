//Toggle visibility of create new blog form
const showCreateBlogFormBtn = document.querySelector(
    "#btn-show-create-blog-form"
);
const createBlogForm = document.querySelector(".create-blog-form");

if (showCreateBlogFormBtn) {
    showCreateBlogFormBtn.addEventListener("click", () => {
        if (createBlogForm.classList.contains("hidden")) {
            createBlogForm.classList.remove("hidden");
        } else {
            createBlogForm.classList.add("hidden");
        }
    });
}

//Toggle visibility of edit post form
const showEditPostFormBtn = document.querySelector("#edit-post-btn");
const editPostForm = document.querySelector(".edit-post-form");

if (showEditPostFormBtn) {
    showEditPostFormBtn.addEventListener("click", () => {
        if (editPostForm.classList.contains("hidden")) {
            editPostForm.classList.remove("hidden");
        } else {
            editPostForm.classList.add("hidden");
        }
    });
}

//Cancel edit post
const hideEditPostFormBtn = document.querySelector("#hide-edit-post-form");

if (hideEditPostFormBtn) {
    hideEditPostFormBtn.addEventListener("click", () => {
        editPostForm.classList.add("hidden");
    });
}

//Toggle visibility of add post form
const showCreatePostFormBtn = document.querySelector("#show-create-post-btn");
const createPostForm = document.querySelector(".create-post-form");

if (showCreatePostFormBtn) {
    showCreatePostFormBtn.addEventListener("click", () => {
        if (createPostForm.classList.contains("hidden")) {
            createPostForm.classList.remove("hidden");
        } else {
            createPostForm.classList.add("hidden");
        }
    });
}
