<?php
/**
 * Custom footer for American Caregivers Incorporated
 * Based on the OpenEMR footer
 *
 * @package OpenEMR
 */
?>

<footer class="footer mt-auto">
    <div class="container-fluid">
        <div class="row align-items-center py-2">
            <div class="col-md-6 text-md-left text-center">
                <span class="text-muted small">
                    &copy; <?php echo date('Y'); ?> American Caregivers Incorporated
                </span>
            </div>
            <div class="col-md-6 text-md-right text-center">
                <span class="text-muted small">
                    <strong class="text-primary">iris</strong> - Powered by <strong>dydact</strong> LLC
                </span>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e7e7e7;
        padding: 0.5rem 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        font-family: 'Montserrat', sans-serif;
    }
    
    .text-primary {
        color: var(--iris-primary) !important;
    }
</style> 