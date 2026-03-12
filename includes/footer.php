    </main>
    <footer class="site-footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> Echo Creative Studio. All rights reserved.</p>
            <p>Bringing stories to life through video & creative media.</p>
        </div>
    </footer>
    <script src="<?php echo isset($basePath) ? $basePath : ''; ?>js/analytics.js"></script>
    <script src="<?php echo isset($basePath) ? $basePath : ''; ?>js/main.js"></script>
    <?php if (isset($currentPage)): ?>
        <?php if ($currentPage === 'resonance'): ?><script src="<?php echo isset($basePath) ? $basePath : ''; ?>js/resonance.js"></script><?php endif; ?>
        <?php if ($currentPage === 'treatment'): ?><script src="<?php echo isset($basePath) ? $basePath : ''; ?>js/treatment-pack.js"></script><?php endif; ?>
    <?php endif; ?>
</body>
</html>
