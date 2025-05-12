import './App.css';
import { useState } from 'react';

export default function App() {
  const [alunni, setAlunni] = useState([]);
  const [loading, setLoading] = useState(false);

  function carica() {
    setLoading(true);
    fetch('http://localhost:8080/alunni')
    .then(response => response.json())
    .then(data => {
      setAlunni(data);
      setLoading(false);
    });
  }

  return (
    <div class="MyApp">
      <h1>ALUNNI</h1>
      <table border="1">
        {alunni.map(a => (
          <tr>
            <td>{a.id}</td>
            <td>{a.nome}</td>
            <td>{a.cognome}</td>
          </tr>
        ))}
      </table>

      {loading && <p>Caricamento in corso...</p>}
      { alunni.length === 0 && !loading && <button onClick={carica}>Carica Alunni</button> }
    </div>
  );
}
