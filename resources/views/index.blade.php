<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('/css/index.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/trash.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <title>Главная</title>
</head>
<body>
<div style="display: flex; height: 100%">
    <div style="width: 15%; background-color: #374050">
        <div style="display: flex; height: 10%">
            <div style="background-color: white; width: 40%; height: 80%; border-radius: 0 0 15px 0;">
                <img src="/img/logo.jpg" width="70" style="margin: 20px 20px">
            </div>
            <div style="width: 10%;">

            </div>
            <div style="width: 50%; color: white">
                Enterprise<br>
                Resource<br>
                Planning
            </div>
        </div>
        <span style="color: #FFFFFF; opacity: 0.5; margin-left: 50px">Продукты</span>
    </div>
    <div style="width: 85%; display: flex; flex-direction: column">
        <div style="height: 8%;">
            <nav class="navbar">
                <div class="container-fluid">
                    <ul class="navbar-nav" style="display: flex">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">ПРОДУКТЫ</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div style="height: 92%; background-color: #F2F6FA; display: flex; justify-content: space-between">
            <div style="width: 40%">
                @yield('products')
            </div>
            <div>
                <div class="btn btn-info addProductModal" data-bs-toggle="modal" data-bs-target="#addProductModal"
                     style="margin: 20px 20px; color: white; width: 200px">Добавить
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="addEditProduct" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3" style="display: flex; justify-content: space-between">
                    <h1 class="modal-title fs-5" id="addEditProduct">Добавить продукт</h1>
                    <div class="forValidationErrors">

                    </div>
                    <button type="button" class="btn-close closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <br>
                <form id="addEditProductForm">
                    <div class="mb-3">
                        <label class="col-form-label">Артикул</label>
                        <input type="text" class="form-control" name="article">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Название</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Статус</label>
                        <select class="form-control" name="status">
                            <option value="available">Доступен</option>
                            <option value="unavailable">Не доступен</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <h2 class="modal-title fs-5">Атрибуты</h2>
                    </div>
                    <div class="mb-3" style="display: flex;" id="attributeDiv" hidden>
                        <label class="col-form-label">Название</label>
                        <label class="col-form-label" style="margin-left: 200px">Значение</label>
                    </div>
                    <div class="mb-3 addAttributeDiv">
                        <a href="#" class="addAtribute"
                           style="color: #5FC6F1; text-decoration: underline dashed #5FC6F1;">+ Добавить атрибут</a>
                    </div>
                    <div class="btn btn-info addProduct" style="margin-top: 20px; color: white; width: 200px">Добавить
                    </div>
                    <input type="hidden" class="productsId" name="productsId" value="0">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="productsCardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body productsCard">

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="/js/index.js"></script>
</html>
