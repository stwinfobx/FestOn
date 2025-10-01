<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Assentos</title>
    <style>
        .seat {
            width: 30px;
            height: 30px;
            margin: 5px;
            background-color: #ddd;
            border: 1px solid #333;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            line-height: 30px;
        }
        .selected {
            background-color: #6c6;
        }
        .occupied {
            background-color: #f00;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h1>Seleção de Assentos</h1>
    <div id="seats">
        <!-- Assentos serão gerados aqui -->
    </div>
    <p id="selected-seats">Assentos selecionados: </p>
    <script >
		
document.addEventListener('DOMContentLoaded', () => {
    const rows = 5; // Número de fileiras
    const cols = 8; // Número de colunas
    const seatsContainer = document.getElementById('seats');
    const selectedSeatsDisplay = document.getElementById('selected-seats');
    const selectedSeats = new Set();

    // Função para criar os assentos
    function createSeats() {
        for (let row = 0; row < rows; row++) {
            const rowDiv = document.createElement('div');
            for (let col = 0; col < cols; col++) {
                const seat = document.createElement('div');
                seat.classList.add('seat');
                seat.dataset.seat = `${row}-${col}`;
                seat.innerText = `${String.fromCharCode(65 + row)}${col + 1}`;
                seat.addEventListener('click', () => toggleSeatSelection(seat));
                rowDiv.appendChild(seat);
            }
            seatsContainer.appendChild(rowDiv);
        }
    }

    // Função para alternar a seleção do assento
    function toggleSeatSelection(seat) {
        if (seat.classList.contains('occupied')) return;

        const seatId = seat.dataset.seat;
        if (selectedSeats.has(seatId)) {
            selectedSeats.delete(seatId);
            seat.classList.remove('selected');
        } else {
            selectedSeats.add(seatId);
            seat.classList.add('selected');
        }
        updateSelectedSeatsDisplay();
    }

    // Função para atualizar a exibição dos assentos selecionados
    function updateSelectedSeatsDisplay() {
        const seatList = Array.from(selectedSeats).map(seatId => {
            const [row, col] = seatId.split('-');
            return `${String.fromCharCode(65 + parseInt(row))}${parseInt(col) + 1}`;
        }).join(', ');
        selectedSeatsDisplay.innerText = `Assentos selecionados: ${seatList}`;
    }

    // Cria os assentos na inicialização
    createSeats();
});


    </script>
</body>
</html>
