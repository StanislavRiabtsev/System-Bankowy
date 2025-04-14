document.getElementById('conversionForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    const amount = parseFloat(formData.get('kwota'));
    if (isNaN(amount) || amount <= 0) {
        alert('Wprowadź poprawną kwotę większą niż 0.');
        return;
    }

    fetch('konwert.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const resultBox = document.getElementById('resultBox');
            resultBox.innerHTML = `<p class="result">Result: ${data.result} ${data.waluta_do}</p>`;
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
