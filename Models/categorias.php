<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="script.js" defer></script>
    <title>J&D Technology</title>
</head>
<body>
    <header>
        <h1>J&D Technology - Ventas de Productos</h1>
        <p>Cercado de Lima - 2024</p>
    </header>

    <div class="container">
        <!-- Botones de navegación -->
        <div class="nav-buttons">
            <a href="reportar_incidencia.php" class="nav-button">Reportar Incidencia</a>
        </div>

        <h1>Productos Disponibles</h1>
        <div class="product-list">
            <!-- Producto: Celular -->
            <div class="product">
                <img src="../img/CELULAR.jpg" alt="Celular SAMSUNG" class="CELULAR-img">
                <div class="product-content">
                    <h3>Celular SAMSUNG</h3>
                    <p>
                        Procesador: Octa-Core, Velocidad de CPU: 2.5GHz.<br>
                        Pantalla: 6.5" AMOLED, Resolución: 2400 x 1080.<br>
                        Cámara: 64MP + 12MP + 5MP trasera, 32MP frontal.
                    </p>
                    <div class="price">S/. 2000.00</div>
                    <button onclick="addToCart('Celular XYZ', 2000)">Comprar</button>
                </div>
            </div>
            
            <!-- Producto: PC -->
            <div class="product">
                <img src="../img/PC.png" alt="PC Gamer ZXY" class="PC-img">
                <div class="product-content">
                    <h3>PC Gamer LG</h3>
                    <p>
                        Procesador: Intel Core i7, Velocidad: 3.5GHz.<br>
                        RAM: 16GB, Almacenamiento: 1TB SSD.<br>
                        Tarjeta Gráfica: NVIDIA GTX 1660 Ti.
                    </p>
                    <div class="price">S/. 4500.00</div>
                    <button onclick="addToCart('PC Gamer ZXY', 4500)">Comprar</button>
                </div>
            </div>

            <!-- Producto: Laptop -->
            <div class="product">
                <img src="../img/LAPTO.png" alt="Laptop LENOVO" class="LAPTO-img">
                <div class="product-content">
                    <h3>Laptop LENOVO</h3>
                    <p>
                        Procesador: Intel Core i5, Velocidad: 4.0GHz.<br>
                        RAM: 8GB, Almacenamiento: 512GB SSD.<br>
                        Pantalla: 15.6" Full HD.
                    </p>
                    <div class="price">S/. 3000.00</div>
                    <button onclick="addToCart('Laptop ABC', 3000)">Comprar</button>
                </div>
            </div>

            <!-- Producto: Auriculares -->
            <div class="product">
                <img src="../img/AURICULARES.jpg" alt="Auriculares YTN" class="product-img">
                <div class="product-content">
                    <h3>Auriculares XYZ</h3>
                    <p>Sonido envolvente, Bajas frecuencias profundas.<br>Bluetooth 5.0, Autonomía: 20 horas.</p>
                    <div class="price">S/. 250.00</div>
                    <button onclick="addToCart('Auriculares XYZ', 250)">Comprar</button>
                </div>
            </div>

            <!-- Producto: Tablet -->
            <div class="product">
                <img src="../img/TABLET.png" alt="Tablet LENOVO" class="TABLET-img">
                <div class="product-content">
                    <h3>Tablet LENOVO</h3>
                    <p>Pantalla: 10.1" Full HD, Procesador: Quad-Core.<br>Almacenamiento: 64GB, Batería de 5000mAh.</p>
                    <div class="price">S/. 1200.00</div>
                    <button onclick="addToCart('Tablet ABC', 1200)">Comprar</button>
                </div>
            </div>

            <!-- Producto: Cámara DSLR -->
            <div class="product">
                <img src="../img/CAMARA.jpg" alt="Cámara DSLR Canon EOS 2000D" class="product-img">
                <div class="product-content">
                    <h3>Cámara DSLR Canon EOS 2000D</h3>
                    <p>Sensor: APS-C, Resolución: 24.1MP.<br>Lente incluido: 18-55mm.<br>Graba videos en Full HD.</p>
                    <div class="price">S/. 3500.00</div>
                    <button onclick="addToCart('Cámara DSLR Canon EOS 2000D', 3500)">Comprar</button>
                </div>
            </div>

            <!-- Producto: Monitor Curvo -->
            <div class="product">
                <img src="../img/MONITOR.jpg" alt="Monitor Curvo Samsung" class="product-img">
                <div class="product-content">
                    <h3>Monitor Curvo Samsung</h3>
                    <p>Pantalla: 27" Curva, Resolución: 2560 x 1440.<br>Frecuencia de actualización: 75Hz.</p>
                    <div class="price">S/. 2200.00</div>
                    <button onclick="addToCart('Monitor Curvo Samsung', 2200)">Comprar</button>
                </div>
            </div>

            <!-- Producto: Mouse Inalámbrico -->
            <div class="product">
                <img src="../img/MOUSE.jpg" alt="Mouse Inalámbrico Logitech" class="product-img">
                <div class="product-content">
                    <h3>Mouse Inalámbrico Logitech</h3>
                    <p>Conexión: Bluetooth, Batería recargable, Diseño ergonómico.</p>
                    <div class="price">S/. 100.00</div>
                    <button onclick="addToCart('Mouse Inalámbrico Logitech', 100)">Comprar</button>
                </div>
            </div>

            <!-- Producto: Teclado Mecánico -->
            <div class="product">
                <img src="../img/TECLADO.png" alt="Teclado Mecánico Razer" class="product-img">
                <div class="product-content">
                    <h3>Teclado Mecánico Razer</h3>
                    <p>Teclas: Mecánicas, Retroiluminación RGB.<br>Conexión: USB, Diseño compacto.</p>
                    <div class="price">S/. 800.00</div>
                    <button onclick="addToCart('Teclado Mecánico Razer', 800)">Comprar</button>
                </div>
            </div>
        </div>
        

        
    <footer>
        <p>&copy; 2024 J&D Technology. Todos los derechos reservados.</p>
    </footer>
    <link rel="stylesheet" href="../css/categorias.css">
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="script.js" defer></script>
    <title>J&D Technology</title>
</head>
<body>
    <header>
        <h1>J&D Technology - Ventas de Productos</h1>
        <p>Cercado de Lima - 2024</p>
    </header>

    <div class="container">
        <!-- Formulario para seleccionar el producto -->
        <div class="product-selection">
            <h2>Selecciona el Producto</h2>
            <form id="product-form">
                <label for="product">Producto:</label>
                <select id="product" name="product">
                    <option value="Celular SAMSUNG">Celular SAMSUNG</option>
                    <option value="PC Gamer LG">PC Gamer LG</option>
                    <option value="Laptop LENOVO">Laptop LENOVO</option>
                    <option value="Auriculares XYZ">Auriculares XYZ</option>
                    <option value="Tablet LENOVO">Tablet LENOVO</option>
                    <option value="Cámara DSLR Canon EOS 2000D">Cámara DSLR Canon EOS 2000D</option>
                    <option value="Monitor Curvo Samsung">Monitor Curvo Samsung</option>
                    <option value="Mouse Inalámbrico Logitech">Mouse Inalámbrico Logitech</option>
                    <option value="Teclado Mecánico Razer">Teclado Mecánico Razer</option>
                </select>
                <br>
                <label for="quantity">Cantidad:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
                <br>
                <button type="button" onclick="generateReceipt()">Generar Boleta</button>
            </form>
        </div>

        <!-- Sección donde se mostrará la boleta -->
        <div id="receipt-section" style="display:none;">
            <h2>Boleta de Compra</h2>
            <div id="receipt-content">
                <!-- Boleta será generada aquí -->
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 J&D Technology. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Función para generar la boleta de compra
        function generateReceipt() {
            const product = document.getElementById("product").value;
            const quantity = document.getElementById("quantity").value;

            let price;
            switch (product) {
                case 'Celular SAMSUNG':
                    price = 2000;
                    break;
                case 'PC Gamer LG':
                    price = 4500;
                    break;
                case 'Laptop LENOVO':
                    price = 3000;
                    break;
                case 'Auriculares XYZ':
                    price = 250;
                    break;
                case 'Tablet LENOVO':
                    price = 1200;
                    break;
                case 'Cámara DSLR Canon EOS 2000D':
                    price = 3500;
                    break;
                case 'Monitor Curvo Samsung':
                    price = 2200;
                    break;
                case 'Mouse Inalámbrico Logitech':
                    price = 100;
                    break;
                case 'Teclado Mecánico Razer':
                    price = 800;
                    break;
                default:
                    price = 0;
                    break;
            }

            const total = price * quantity;

            // Crear el contenido de la boleta
            const receiptContent = `
                <p><strong>Producto:</strong> ${product}</p>
                <p><strong>Cantidad:</strong> ${quantity}</p>
                <p><strong>Precio Unitario:</strong> S/. ${price}</p>
                <p><strong>Total:</strong> S/. ${total}</p>
                <p><strong>Fecha:</strong> ${new Date().toLocaleString()}</p>
                <button onclick="window.print();">Imprimir Boleta</button>
            `;

            // Mostrar la boleta
            document.getElementById("receipt-content").innerHTML = receiptContent;
            document.getElementById("receipt-section").style.display = 'block';
        }
    </script>
</body>
 <!-- Botón para regresar a PMENU.php -->
 <div style="margin-top: 20px; text-align: center;">
        <a href="PMENU.php" class="nav-button" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Regresar</a>
    </div>
</div>
    </div>
</div>
</html>