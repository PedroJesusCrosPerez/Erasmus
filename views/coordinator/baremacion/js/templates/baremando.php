<?php
echo '
    <div name="dbaremar">
        <table name="tbaremar">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Fichero</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Idoneidad</td>
                    <td><button class="idoneidad">VISUALIZAR</button></td>
                    <td><input type="number" name="nota"></td>
                </tr>
                <tr>
                    <td>Entrevista</td>
                    <td><button class="entrevista">VISUALIZAR</button></td>
                    <td><input type="number" name="nota"></td>
                </tr>
                <tr>
                    <td>Idiomas</td>
                    <td><button class="idiomas">VISUALIZAR</button></td>
                    <td><input type="number" name="nota"></td>
                </tr>
            </tbody>
        </table>
        <button>CONFIRMAR</button>
    </div>
';
?>