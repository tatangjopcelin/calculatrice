@echo off
echo ============================
echo == Lancement des tests... ==
echo ============================
echo.

:: Vérifie que composer est installé
where composer >nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    echo ❌ Composer n'est pas installé ou pas dans le PATH.
    pause
    exit /b 1
)

:: Exécute PHPUnit via Composer
composer test

:: Affiche le code de retour
IF %ERRORLEVEL% EQU 0 (
    echo.
    echo ✅ Tests réussis !
) ELSE (
    echo.
    echo ❌ Des tests ont échoué.
)

pause
