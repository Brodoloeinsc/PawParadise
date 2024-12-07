<?php

    class PlanFactory {
        // Valida o plano
        public static function validatePlan($plano_atual, $plano_selecionado) {
            // Verifica se o plano é válido e se não há seleção de plano igual ao atual
            return ($plano_atual >= 0 && $plano_atual <= 4 && $plano_selecionado >= 0 && $plano_selecionado <= 4 && $plano_atual !== $plano_selecionado);
        }

        // Atualiza o plano do usuário no banco de dados
        public static function updateUserPlan($email, $plano_selecionado) {
            $query = "UPDATE \"user\" SET plan = $1 WHERE email = $2";
            return pg_query_params($query, array($plano_selecionado, $email));
        }
    }

?>