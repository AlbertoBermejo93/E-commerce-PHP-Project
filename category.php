<div class="row my-5">
    <div class="col-4">
        <div class="cat">
            <img src="" alt="">
            <a class="btn-flip text-dark" data-back="Back" data-front="Front" href="#">T-shirts</a>
        </div>
        <div class="cat">
            <img src="" alt="">
            <a class="text-dark" href="#">Pulls</a>
        </div>
    </div>
    <div class="col-4">
        <div class="cat">
            <img src="" alt="">
            <a class="text-dark" href="#">Pantalons</a>
        </div>
        <div class="cat">
            <img src="" alt="">
            <a class="text-dark" href="#">Accessoires</a>
        </div>
    </div>
    <div class="col-4">
        <div class="cat">
            <img src="" alt="">
            <a class="text-dark" href="#">Chaussures</a>
        </div>
        <div class="cat">
            <img src="" alt="">
            <a class="text-danger" href="#">SOLDES</a>
        </div>
    </div>
</div>

<style>
    .cat {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f0f0f0;
        width: 100%;
        height: 120px;
        margin-bottom: 15px;
        transition: 0.5s;
        cursor: pointer;
    }

    .cat a{
        font-size: 20px;
        text-decoration: none;
        font-weight: 600;
    }

    .cat:hover {
        background: #ffc107;
    }

    .cat:hover a{
        color: #fff;
    }
</style>