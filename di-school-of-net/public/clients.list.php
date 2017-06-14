<table>
    <tr>
        <td>
            Id
        </td>
        <td>
            Nome
        </td>
        <td>
            Email
        </td>
    </tr>

    <?php foreach ($listaClientes as $cliente) : ?>

        <tr>
            <td>
                <?php echo $cliente['id']; ?>
            </td>
            <td>
                <?php echo $cliente['nome']; ?>
            </td>
            <td>
                <?php echo $cliente['email']; ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>
