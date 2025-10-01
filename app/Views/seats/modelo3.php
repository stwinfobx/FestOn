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
            margin: 3px;
            background-color: #ddd;
            border: 1px solid #333;
            display: inline-block;
            text-align: center;
            line-height: 30px;
			text-align: center;
			border-radius: 4px;
        }
        .empty {
            width: 30px;
            height: 30px;
            margin: 5px;
            display: inline-block;
        }
        .row {
            margin-bottom: 10px;
        }
        .layout-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Seleção de Assentos</h1>

    <h1>Dashboard de Distribuição de Assentos</h1>
    <form id="layoutForm">
        <label for="columnName">Nome da Coluna:</label>
        <input type="text" id="columnName" name="columnName" required>
        <br>
        <label for="columnSeats">Assentos (X para assento, _ para espaço):</label>
        <input type="text" id="columnSeats" name="columnSeats" required>
        <br>
        <button type="button" onclick="addColumn()">Adicionar Coluna</button>
    </form>

    <div id="layoutContainer" class="layout-container"></div>

    <script>
        function addColumn() {
            const columnName = document.getElementById('columnName').value;
            const columnSeats = document.getElementById('columnSeats').value;
            
            const columnDiv = document.createElement('div');
            columnDiv.className = 'row';
            columnDiv.innerHTML = `<strong>${columnName}</strong>: `;

            let seatNumber = 1;

            for (let char of columnSeats) {
                const seatDiv = document.createElement('div');
                if (char === 'X') {
                    seatDiv.className = 'seat';
                    seatDiv.textContent = seatNumber++;
                } else {
                    seatDiv.className = 'empty';
                }
                columnDiv.appendChild(seatDiv);
            }

            document.getElementById('layoutContainer').appendChild(columnDiv);

            // Clear input fields
            document.getElementById('layoutForm').reset();
        }
    </script>

</body>
</html>
