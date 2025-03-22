document.getElementById("emailForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let email = document.querySelector("input[name='email']").value;
    let campaignName = document.querySelector("input[name='campaign_name']").value;
    let content = document.querySelector("textarea[name='email_content']").value;

    // AJAX request to backend (send email)
    fetch("send-email.php", {
        method: "POST",
        body: new URLSearchParams({
            email: email,
            campaign_name: campaignName,
            email_content: content
        }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => console.error('Error:', error));
});
