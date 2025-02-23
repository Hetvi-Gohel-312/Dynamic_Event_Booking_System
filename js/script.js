document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("a").forEach(a => {
        a.addEventListener("click", function(event) {
            if (a.textContent.includes("Delete") || a.textContent.includes("Cancel")) {
                if (!confirm("Are you sure?")) {
                    event.preventDefault();
                }
            }
        });
    });
});
