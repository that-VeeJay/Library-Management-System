// Removes notification after delay

setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach((alert) => {
        alert.remove();
    })
}, 5000);