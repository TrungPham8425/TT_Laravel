<style>
    .alert-success {
        background: #e6f9ed;
        color: #20734b;
        border: 1px solid #b6e2c6;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 18px;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .alert-success .icon {
        font-size: 22px;
    }
</style>
<div class="alert alert-success">
    <span class="icon">✔️</span>
    {{ session('success') }}
</div>