import { useState } from 'react';

function CurrencyConverter() {
    const [amount, setAmount] = useState('');
    const [converted, setConverted] = useState(null);

    const handleConvert = () => {
        const rate = 4.5; // przykładowy kurs PLN -> EUR
        const result = (parseFloat(amount) / rate).toFixed(2);
        setConverted(result);
    };

    return (
        <div style={{ padding: '20px', border: '1px solid #ccc', borderRadius: '8px' }}>
            <h2>Konwerter walut</h2>
            <input
                type="number"
                placeholder="Wpisz kwotę w PLN"
                value={amount}
                onChange={(e) => setAmount(e.target.value)}
                style={{ marginRight: '10px', padding: '5px' }}
            />
            <button onClick={handleConvert} style={{ padding: '5px 10px' }}>
                Przelicz na EUR
            </button>

            {converted !== null && (
                <div style={{ marginTop: '20px' }}>
                    <strong>Wynik:</strong> {converted} EUR
                </div>
            )}
        </div>
    );
}

export default CurrencyConverter;
