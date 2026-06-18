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

    .admin-blog-create-wrap {
        max-width: 980px;
        padding-left: 18px;
        padding-right: 18px;
        width: 100%;
    }

    .admin-blog-create-panel {
        padding: 22px;
    }

    .admin-blog-view-wrap {
        max-width: 1180px;
        padding-left: 18px;
        padding-right: 18px;
        width: 100%;
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
        padding: 22px;
    }

    .admin-blog-hero h3 {
        color: #fff;
        font-size: 24px;
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
        gap: 18px;
        margin-top: 22px;
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
        min-height: 220px;
        resize: vertical;
    }

    .admin-blog-editor-toolbar {
        background: #f4f4f4;
        border: 1px solid #d9dde2;
        border-bottom: 0;
        border-radius: 8px 8px 0 0;
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        padding: 10px;
    }

    .admin-blog-editor-toolbar button {
        background: #fff;
        border: 1px solid #d9dde2;
        border-radius: 6px;
        color: #050a1e;
        cursor: pointer;
        font-size: 13px;
        font-weight: 800;
        padding: 8px 10px;
    }

    .admin-blog-editor-toolbar button:hover {
        border-color: var(--theme-color1, #971736);
        color: var(--theme-color1, #971736);
    }

    .admin-blog-editor-toolbar + textarea {
        border-radius: 0 0 8px 8px;
        font-family: Consolas, Monaco, monospace;
        min-height: 280px;
    }

    .admin-blog-editor-help {
        color: #7a7a7a;
        font-size: 13px;
        margin: 8px 0 0;
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

    .admin-col-title {
        width: 17%;
    }

    .admin-col-banner {
        width: 14%;
    }

    .admin-col-preview {
        width: 23%;
    }

    .admin-col-date {
        width: 13%;
    }

    .admin-col-status {
        width: 11%;
    }

    .admin-col-actions {
        width: 14%;
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
        word-break: normal;
    }

    .admin-blog-title-cell {
        color: #050a1e !important;
        font-weight: 500;
        overflow-wrap: anywhere;
    }

    .admin-blog-preview-cell {
        color: #646464 !important;
        line-height: 1.45;
    }

    .admin-blog-preview-cell span {
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        display: -webkit-box;
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
        min-width: 0;
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

    .admin-blog-view-shell {
        background: #f4f4f4;
        border: 1px solid #e5e7e9;
        border-radius: 8px;
        padding: 18px;
    }

    .admin-blog-view-banner {
        border-radius: 8px;
        margin-bottom: 18px;
        max-height: 360px;
        overflow: hidden;
    }

    .admin-blog-view-banner img {
        display: block;
        height: 360px;
        object-fit: cover;
        width: 100%;
    }

    .admin-blog-view-grid {
        align-items: start;
        display: grid;
        gap: 18px;
        grid-template-columns: minmax(0, 1fr) 280px;
    }

    .admin-blog-preview {
        background: #fff;
        border: 1px solid #e5e7e9;
        border-radius: 8px;
        overflow: hidden;
    }

    .admin-blog-preview-body {
        padding: 34px;
    }

    .admin-blog-view-meta {
        align-items: center;
        color: #7a7a7a;
        display: flex;
        flex-wrap: wrap;
        font-size: 12px;
        gap: 10px;
        margin-bottom: 14px;
        text-transform: uppercase;
    }

    .admin-blog-preview-body h1 {
        color: #050a1e;
        font-size: 34px;
        font-weight: 600;
        line-height: 1.2;
        margin: 0 0 22px;
        overflow-wrap: anywhere;
    }

    .admin-blog-preview-body p {
        color: #646464;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 14px;
    }

    .admin-blog-preview-copy h1,
    .admin-blog-preview-copy h2,
    .admin-blog-preview-copy h3,
    .admin-blog-preview-copy h4,
    .admin-blog-preview-copy h5,
    .admin-blog-preview-copy h6 {
        color: #050a1e;
        font-weight: 600;
        line-height: 1.25;
        margin: 24px 0 12px;
    }

    .admin-blog-preview-copy h2 {
        font-size: 26px;
    }

    .admin-blog-preview-copy h3 {
        font-size: 22px;
    }

    .admin-blog-preview-copy ul,
    .admin-blog-preview-copy ol {
        color: #646464;
        line-height: 1.8;
        margin: 0 0 18px 22px;
        padding-left: 16px;
    }

    .admin-blog-preview-copy blockquote {
        background: rgba(151, 23, 54, .07);
        border-left: 4px solid var(--theme-color1, #971736);
        color: #233e50;
        font-style: italic;
        line-height: 1.75;
        margin: 22px 0;
        padding: 16px 20px;
    }

    .admin-blog-preview-copy a {
        color: var(--theme-color1, #971736);
        font-weight: 700;
        text-decoration: underline;
    }

    .admin-blog-preview-copy img {
        border-radius: 8px;
        display: block;
        height: auto;
        margin: 24px 0;
        max-height: 520px;
        max-width: 100%;
        object-fit: cover;
        width: auto;
    }

    .admin-blog-view-summary {
        background: #fff;
        border: 1px solid #e5e7e9;
        border-radius: 8px;
        padding: 22px;
        position: sticky;
        top: 90px;
    }

    .admin-blog-view-summary dl {
        display: grid;
        gap: 14px;
        margin: 12px 0 0;
    }

    .admin-blog-view-summary div {
        border-bottom: 1px solid #edf0f2;
        padding-bottom: 12px;
    }

    .admin-blog-view-summary div:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .admin-blog-view-summary dt {
        color: #7a7a7a;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .admin-blog-view-summary dd {
        color: #050a1e;
        font-weight: 700;
        margin: 4px 0 0;
    }

    @media (max-width: 768px) {
        .admin-blog-panel {
            padding: 16px;
        }

        .admin-blog-create-wrap {
            padding-left: 12px;
            padding-right: 12px;
        }

        .admin-blog-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
        }

        .admin-blog-grid {
            grid-template-columns: 1fr;
        }

        .admin-blog-view-wrap {
            padding-left: 12px;
            padding-right: 12px;
        }

        .admin-blog-view-grid {
            grid-template-columns: 1fr;
        }

        .admin-blog-view-banner img {
            height: 230px;
        }

        .admin-blog-preview-body {
            padding: 22px;
        }

        .admin-blog-preview-body h1 {
            font-size: 27px;
        }

        .admin-blog-view-summary {
            position: static;
        }
    }
</style>
