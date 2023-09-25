// script.js

document.getElementById("backButton").addEventListener("click", function () {
    window.location.href = "previous_page.html";
});

document.getElementById("submitButton").addEventListener("click", function () {
    // ... Form submission logic ...

    // After validation and submission, redirect to a success page
    // window.location.href = "success_page.html";
});

// Fetch categories from the admin page (admin.php)
fetch("admin.php") // Replace with the actual URL admin page
    .then((response) => response.text())
    .then((data) => {
        const categorySelect = document.getElementById("category");
        const categories = data.split("\n").map(category => category.trim());

        
        categories.forEach((category) => {
            if (category) {
                const option = document.createElement("option");
                option.value = category;
                option.textContent = category;
                categorySelect.appendChild(option);
            }
        });
    })
    .catch((error) => {
        console.error("Error fetching categories: ", error);
    });
