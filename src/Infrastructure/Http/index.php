<?php

$path = $argv[1] ?? './';

$wallets = json_decode(file_get_contents('./wallets.json'), true);

$currency = 'USD';
$investmentWallets = [];

foreach ($wallets as $type => $wallet) {
    $jsonAddress = json_decode(
        exec('php '.$path.'app.php command:getBalanceByAddressWallet '.$type.' '.$wallet['address']),
        true
    );

    $balanceAddress  = $jsonAddress['balance'] / $wallet['decimals'];

    $balanceAddressUsd = json_decode(
        exec('php '.$path.'app.php command:getExchange '.$type.' '.$balanceAddress.' '.$currency),
        true
    );

    $investmentWallets[$type.' Wallet'] = [
        $type.' Wallet' => $balanceAddress,
        $currency => $balanceAddressUsd['amount'],
        'address' => $wallet['address'],
        'urlExplorer' => $wallet['urlExplorer'],
    ];
}

$total = 0;

foreach ($investmentWallets as $type => $investmentWallet) {
    $address = $investmentWallet['address'];
    $urlExplorer = $investmentWallet['urlExplorer'];
    echo "$type: <a target='_blank' href='https://www.blockchain.com/btc/address/$urlExplorer $address'>$address</a> <br /><br /><br />";
}

echo "<table border='1'>";
            
$criptoInvestment = json_decode(exec('php '.$path.'app.php command:getInvestmentByFiat '.$currency), true);
$investments = array_merge($criptoInvestment, $investmentWallets);

foreach ($investments as $code => $crypto) {
        echo "<tr>";
        echo "<td>$code</td><td align='right'><strong>".number_format($crypto[$currency],2,',','.')."</strong> $currency</td>";
        echo "</tr>";
        $total += $crypto[$currency];
}

echo "</table><br/><br/>";
echo "<strong>Total: ".number_format($total,2,',','.')." $currency</strong>";