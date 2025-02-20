<?php

public function messageToUser($msg, $type = 'success') {
    // ... existing code ...
    
    // Adiciona log para monitorar envio de mensagem
    error_log("[" . date('Y-m-d H:i:s') . "] Mensagem enviada para usuário: " . $msg . " (Tipo: " . $type . ")");
    
    $_SESSION['msg'] = $msg;
    $_SESSION['type'] = $type;
    // ... existing code ...
} 