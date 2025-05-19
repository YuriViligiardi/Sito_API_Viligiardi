import './App.css';
import { useState } from 'react';

export default function App() {
  const [alunni, setAlunni] = useState([]);
  const [loading, setLoading] = useState(false);
  const [insert, setInsert] = useState(false);
  const [newName, setNewName] = useState("");
  const [newSurname, setNewSurname] = useState("");
  const [confirmDelete, setConfirmDelete] = useState(null);

  async function carica() {
    setLoading(true);
    const response = await fetch("http://localhost:8080/alunni");
    const data = await response.json();
    setTimeout(() => {
      setAlunni(data)
      setLoading(false)
    }, 1000);
  }

  function showForm() {
    setInsert(true);
  }

  async function saveAlunno() {
    if (!newName.trim() || !newSurname.trim()) {
      alert("TUTTI I CAMPI SONO OBBLIGATORI!");
      return;
    }

    const newAlunno= {nome : newName, cognome: newSurname};

    const response = await fetch("http://localhost:8080/alunni", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: JSON.stringify(newAlunno),
    });

    await response.json();

    setInsert(false);
    setNewName("");
    setNewSurname("");
    carica();
  }

  function nullInsert() {
    setInsert(false);
    setNewName("");
    setNewSurname("");
  }

  async function deleteAlunno(id) {
    const response = await fetch(`http://localhost:8080/alunni/${id}`, {
      method: "DELETE",
    });

    if (response.ok) {
      setAlunni(alunni.filter(a => a.id !== id)); // Aggiorna la lista dopo l'eliminazione
      setConfirmDelete(null); // Resetta la conferma
    } else {
      alert("Errore durante l'eliminazione!");
    }

    await response.json();
  }

  return (
    <div class="MyApp">
      <h1>ALUNNI</h1>
        {alunni.length > 0 && (
          <table border="1">
            <thead>
              <tr> 
                <th>ID</th>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>AZIONI</th>
              </tr>
            </thead>
            <tbody>
              {alunni.map(a => (
                <tr>
                  <td>{a.id}</td>
                  <td>{a.nome}</td>
                  <td>{a.cognome}</td>
                  <td>
                    {confirmDelete === a.id ? (
                      <>
                        <span>Sei sicuro? </span>
                        <button onClick={() => deleteAlunno(a.id)}>Sì</button>
                        <button onClick={() => setConfirmDelete(null)}>No</button>
                      </>
                    ) : (
                      <button onClick={() => setConfirmDelete(a.id)}>Elimina</button>
                    )}
                </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      <br />
      { alunni.length > 0 && <button onClick={showForm}>Inserisci nuovo alunno</button> }
      <br />
      {insert && (
        <div className="form-container">
          <input 
          type='text'
          placeholder='Nome'
          value={newName}
          onChange={(e) => setNewName(e.target.value)}
          required
          />  
          <br />
          <input 
          type='text'
          placeholder='Cognome'
          value={newSurname}
          onChange={(e) => setNewSurname(e.target.value)}
          required
          />   
          <br />
          <button onClick={saveAlunno}>SALVA</button>
          <button onClick={nullInsert}>ANNULLA</button>
        </div>
      )}
        
      {loading && <p>Caricamento in corso...</p>}
      { alunni.length === 0 && !loading && <button onClick={carica}>Carica Alunni</button> }
      
    </div>
  );
}
