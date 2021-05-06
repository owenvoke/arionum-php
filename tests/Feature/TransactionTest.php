<?php

declare(strict_types=1);

use OwenVoke\Arionum\Models\Asset;
use OwenVoke\Arionum\Models\Transaction;
use OwenVoke\Arionum\Tests\TestCase;
use OwenVoke\Arionum\Transaction\TransactionFactory;
use OwenVoke\Arionum\Transaction\Version;

beforeEach(function () {
    $this->testTransactionId = '2bAhimfbpzbKuH2E3uFZjK2cBQ9KrUtSvHPXdnGYSqYRE6tYVkLYa9hqTZpyjp6s2ZVoxpWaz5JvgyL8sYjM8Zsq';
    $this->testAlias = 'pxgamer';
    $this->testIp = '127.0.0.1';
})->withArionum();

it('gets a transaction by its id', function (): void {
    $data = $this->arionum->getTransaction($this->testTransactionId);
    $this->assertObjectHasAttribute('version', $data);
});

it('gets the number of transactions in the mempool', function (): void {
    $data = $this->arionum->getMempoolSize();
    $this->assertIsInt($data);
});

it('can generate an alias send transaction', function (): void {
    $data = TransactionFactory::makeAliasSendInstance($this->testAlias, 1.0);
    $this->assertEquals($this->testAlias, $data->getDestinationAddress());
    $this->assertEquals(1.0, $data->getValue());
    $this->assertEquals(Version::ALIAS_SEND, $data->getVersion());
});

it('can generate an alias set transaction', function (): void {
    $data = TransactionFactory::makeAliasSetInstance(TestCase::TEST_ADDRESS, $this->testAlias);
    $this->assertEquals(TestCase::TEST_ADDRESS, $data->getDestinationAddress());
    $this->assertEquals($this->testAlias, $data->getMessage());
    $this->assertEquals(Version::ALIAS_SET, $data->getVersion());
    $this->assertEquals(Transaction::VALUE_ALIAS_SET, $data->getValue());
});

it('can generate a masternode create transaction', function (): void {
    $data = TransactionFactory::makeMasternodeCreateInstance($this->testIp, TestCase::TEST_ADDRESS);
    $this->assertEquals(TestCase::TEST_ADDRESS, $data->getDestinationAddress());
    $this->assertEquals($this->testIp, $data->getMessage());
    $this->assertEquals(Version::MASTERNODE_CREATE, $data->getVersion());
    $this->assertEquals(Transaction::VALUE_MASTERNODE_CREATE, $data->getValue());
    $this->assertEquals(Transaction::FEE_MASTERNODE_CREATE, $data->getFee());
});

it('can generate a masternode pause transaction', function (): void {
    $data = TransactionFactory::makeMasternodePauseInstance(TestCase::TEST_ADDRESS);
    $this->assertEquals(TestCase::TEST_ADDRESS, $data->getDestinationAddress());
    $this->assertEquals(Version::MASTERNODE_PAUSE, $data->getVersion());
    $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->getValue());
    $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->getFee());
});

it('can generate a masternode resume transaction', function (): void {
    $data = TransactionFactory::makeMasternodeResumeInstance(TestCase::TEST_ADDRESS);
    $this->assertEquals(TestCase::TEST_ADDRESS, $data->getDestinationAddress());
    $this->assertEquals(Version::MASTERNODE_RESUME, $data->getVersion());
    $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->getValue());
    $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->getFee());
});

it('can generate a masternode release transaction', function (): void {
    $data = TransactionFactory::makeMasternodeReleaseInstance(TestCase::TEST_ADDRESS);
    $this->assertEquals(TestCase::TEST_ADDRESS, $data->getDestinationAddress());
    $this->assertEquals(Version::MASTERNODE_RELEASE, $data->getVersion());
    $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->getValue());
    $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->getFee());
});

it('can generate an asset create transaction', function (): void {
    $asset = new Asset(100, 1, false, false, false, false);

    $data = TransactionFactory::makeAssetCreateInstance($asset);

    $this->assertEquals(Version::ASSET_CREATE, $data->getVersion());
    $this->assertEquals(100, $data->getValue());
    $this->assertEquals(json_encode([100, 0, '1.00000000', 0, 0, 0]), $data->getMessage());
});

it('can generate an asset send transaction', function (): void {
    $data = TransactionFactory::makeAssetSendInstance('ARO', 'ARO', 1.0);

    $this->assertEquals(Version::ASSET_SEND, $data->getVersion());
    $this->assertEquals(0.00000001, $data->getValue());
    $this->assertEquals(json_encode(['ARO', 1.0]), $data->getMessage());
    $this->assertEquals('ARO', $data->getDestinationAddress());
});

it('can generate an asset market transaction', function (): void {
    $data = TransactionFactory::makeAssetMarketInstance('ARO', 1.0, 1.0, 'ask', false);

    $this->assertEquals(Version::ASSET_MARKET, $data->getVersion());
    $this->assertEquals(0.00000001, $data->getValue());
    $this->assertEquals(json_encode(['ARO', 1.0, 1.0, false, 'ask']), $data->getMessage());
});

it('can generate an asset cancel order transaction', function (): void {
    $data = TransactionFactory::makeAssetCancelOrderInstance('order-id');

    $this->assertEquals(Version::ASSET_CANCEL_ORDER, $data->getVersion());
    $this->assertEquals(0.00000001, $data->getValue());
    $this->assertEquals('order-id', $data->getMessage());
});

it('can generate an asset dividends transaction', function (): void {
    $data = TransactionFactory::makeAssetDividendsInstance(100);

    $this->assertEquals(Version::ASSET_DIVIDENDS, $data->getVersion());
    $this->assertEquals(100, $data->getValue());
    $this->assertEquals('', $data->getMessage());
});

it('can generate an asset inflate transaction', function (): void {
    $data = TransactionFactory::makeAssetInflateInstance(1);

    $this->assertEquals(Version::ASSET_INFLATE, $data->getVersion());
    $this->assertEquals(0.00000001, $data->getValue());
    $this->assertEquals('1', $data->getMessage());
});
