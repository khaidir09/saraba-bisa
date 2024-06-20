<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Label Inventaris</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            td {
                border: 1px solid #000;
                text-align: center;
                padding: 10px;
            }
            .label-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .label-image {
                width: 50px; /* Sesuaikan dengan ukuran gambar yang diinginkan */
                height: 50px; /* Sesuaikan dengan ukuran gambar yang diinginkan */
            }
            .label-text {
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    @foreach ($inventories as $item)
                        <td>
                            <div class="label-container">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" alt="Logo" class="label-image">
                                <div class="label-text">{{ $item->name }} - {{ $item->code }}</div>
                                <div class="label-text">{{ $users->nama_toko }}</div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </body>
</html>
