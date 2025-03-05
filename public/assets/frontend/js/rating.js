// Updating the message based on rating selection
document.querySelectorAll(".form-check-input").forEach((radio) => {
    radio.addEventListener("change", function () {
        let header = document.querySelector("header");
        let messages = {
            "rate-1": "I just hate it",
            "rate-2": "I don't like it",
            "rate-3": "It is awesome",
            "rate-4": "I just like it",
            "rate-5": "I just love it",
        };
        header.textContent = messages[this.id];

        // Show the submit button when a rating is selected
        document.getElementById("submit-rating").style.display = "block";
    });
});

// Selecting all the stars
const stars = document.querySelectorAll(".form-check-label");

// Adding event listener on each star
stars.forEach((star, index) => {
    star.addEventListener("click", () => {
        // Remove the 'selected' class from all stars
        stars.forEach((s) => s.classList.remove("selected"));

        // Add the 'selected' class to the clicked star and all previous stars
        for (let i = 0; i <= index; i++) {
            stars[i].classList.add("selected");
        }
    });
});
