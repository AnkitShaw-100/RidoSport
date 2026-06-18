<style>
    .admin-blog-page {
        background:
            radial-gradient(circle at top left, rgba(151, 23, 54, .10), transparent 32%),
            #f4f4f4;
    }

    .admin-blog-panel {
        background: #fff;
        border: 1px solid #e5e7e9;
        border-radius: 8px;
        box-shadow: 0 18px 45px rgba(5, 10, 30, .09);
        padding: 24px;
    }

    .admin-alert {
        border-radius: 8px;
        display: flex;
        gap: 8px;
        margin-bottom: 18px;
        padding: 13px 16px;
    }

    .admin-alert-success {
        background: rgba(151, 23, 54, .08);
        border: 1px solid rgba(151, 23, 54, .25);
        color: var(--theme-color1, #971736);
    }

    .admin-alert-danger {
        background: #fff1f1;
        border: 1px solid #ef9a9a;
        color: #9f1d1d;
    }

    .admin-blog-hero {
        align-items: center;
        background: linear-gradient(135deg, #050a1e, #233e50);
        border-radius: 8px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 26px;
    }

    .admin-blog-hero h3 {
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        line-height: 1.15;
        margin: 0 0 6px;
    }

    .admin-blog-hero p {
        color: #f4f4f4;
        margin: 0;
    }

    .admin-blog-kicker {
        color: var(--theme-color1, #971736);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .09em;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .admin-blog-button,
    .admin-blog-submit {
        background: var(--theme-color1, #971736);
        border: 0;
        border-radius: 6px;
        color: #fff;
        display: inline-flex;
        font-weight: 800;
        justify-content: center;
        line-height: 1;
        padding: 13px 20px;
        text-decoration: none;
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        white-space: nowrap;
    }

    .admin-blog-button:hover,
    .admin-blog-submit:hover {
        background: #7f112c;
        box-shadow: 0 12px 24px rgba(151, 23, 54, .24);
        color: #fff;
        transform: translateY(-1px);
    }

    .admin-blog-form {
        display: grid;
        gap: 22px;
        margin-top: 26px;
    }

    .admin-blog-grid {
        display: grid;
        gap: 18px;
        grid-template-columns: 1fr 220px;
    }

    .admin-blog-field label,
    .admin-blog-upload label {
        color: #050a1e;
        display: block;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .admin-blog-field input,
    .admin-blog-field select,
    .admin-blog-field textarea,
    .admin-blog-upload input {
        background: #fff !important;
        border: 1px solid #d9dde2;
        border-radius: 8px;
        color: #050a1e !important;
        display: block;
        font-size: 15px;
        line-height: 1.5;
        outline: none;
        padding: 13px 14px;
        width: 100%;
    }

    .admin-blog-field textarea {
        min-height: 260px;
        resize: vertical;
    }

    .admin-blog-field input::placeholder,
    .admin-blog-field textarea::placeholder {
        color: #9e9e9e;
    }

    .admin-blog-field input:focus,
    .admin-blog-field select:focus,
    .admin-blog-field textarea:focus,
    .admin-blog-upload input:focus {
        border-color: var(--theme-color1, #971736);
        box-shadow: 0 0 0 4px rgba(151, 23, 54, .12);
    }

    .admin-blog-upload {
        background: #f4f4f4;
        border: 1px dashed rgba(151, 23, 54, .42);
        border-radius: 8px;
        padding: 18px;
    }

    .admin-blog-upload p {
        color: #7a7a7a;
        font-size: 13px;
        margin: 10px 0 0;
    }

    .admin-blog-current-image {
        border-radius: 8px;
        display: block;
        height: 230px;
        object-fit: cover;
        width: 100%;
    }

    .admin-blog-form-actions {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .admin-blog-secondary {
        background: #fff;
        border: 1px solid #d9dde2;
        border-radius: 6px;
        color: #050a1e;
        display: inline-flex;
        font-weight: 800;
        padding: 12px 18px;
        text-decoration: none;
    }

    .admin-blog-secondary:hover {
        background: #f4f4f4;
        color: #050a1e;
    }

    .admin-blog-table {
        border: 1px solid #e5e7e9;
        border-radius: 8px;
        overflow: hidden;
        table-layout: fixed;
    }

    .admin-blog-table th {
        background: #050a1e;
        color: #fff;
        font-size: 12px;
        letter-spacing: .04em;
        padding: 13px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .admin-blog-table td {
        border-bottom: 1px solid #e5e7e9;
        color: #303030;
        padding: 13px;
        vertical-align: middle;
        word-break: break-word;
    }

    .admin-blog-title-cell {
        color: #050a1e !important;
        font-weight: 500;
        width: 18%;
    }

    .admin-blog-preview-cell {
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        color: #646464 !important;
        display: -webkit-box;
        line-height: 1.55;
        max-width: 280px;
        overflow: hidden;
        overflow-wrap: anywhere;
        white-space: normal;
    }

    .admin-blog-thumb {
        border-radius: 6px;
        height: 64px;
        object-fit: cover;
        width: 96px;
    }

    .admin-blog-status {
        border-radius: 999px;
        display: inline-flex;
        font-size: 12px;
        font-weight: 800;
        padding: 6px 10px;
    }

    .admin-blog-status-published {
        background: rgba(151, 23, 54, .10);
        color: var(--theme-color1, #971736);
    }

    .admin-blog-status-draft {
        background: #edf2f5;
        color: #233e50;
    }

    .admin-blog-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        min-width: 150px;
    }

    .admin-action-link {
        border: 0;
        border-radius: 6px;
        color: #fff;
        cursor: pointer;
        display: inline-flex;
        font-size: 13px;
        font-weight: 800;
        padding: 8px 11px;
        text-decoration: none;
    }

    .admin-action-view {
        background: #233e50;
    }

    .admin-action-edit {
        background: var(--theme-color1, #971736);
        color: #fff;
    }

    .admin-action-delete {
        background: #b42318;
    }

    .admin-blog-preview {
        border: 1px solid #e5e7e9;
        border-radius: 8px;
        overflow: hidden;
    }

    .admin-blog-preview img {
        display: block;
        height: 360px;
        object-fit: cover;
        width: 100%;
    }

    .admin-blog-preview-body {
        padding: 26px;
    }

    .admin-blog-preview-body h1 {
        color: #050a1e;
        font-size: 30px;
        font-weight: 800;
        margin: 0 0 16px;
    }

    .admin-blog-preview-body p {
        color: #646464;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 14px;
    }

    @media (max-width: 768px) {
        .admin-blog-panel {
            padding: 16px;
        }

        .admin-blog-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
        }

        .admin-blog-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
