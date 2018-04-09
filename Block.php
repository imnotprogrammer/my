<?php
/**
* 区块结构以及信息
*/
class TradeLog {

	private $timestamp;
	private $type;
	private $amount;
	private $account;
	private $toaccount;

	function __construct($account) {
		$this->account = $account;
	}
	function saveTrade($amount, $type, $toaccount){
		//添加到自己的数据库中；
		
		//添加成功后做相应操作
	}
}
class Block {
	private $index; //索引
	private $prev_hash; //上一个区块hash值
	private $data;  //数据
	private $hash; //hash;
	private $timestamp;
	private $diffcult;
	private $nonce;


	function __construct($index, $prev_hash, $data, $timestamp, $diffcult){
		$this->index = $index;
		$this->prev_hash = $prev_hash;
		$this->data = $data;
		$this->timestamp = $timestamp;
		$this->diffcult = $diffcult;
		$this->nonce = rand();
		$this->hash = $this->getHash();
	}
	function dig(){
		$blockHeader = $this->index.$this->prev_hash.$this->data.$this->timestamp.$this->diffcult.$this->nonce.$this->hash;
		$sha256_key = hash('sha256', hash('sha256', $blockHeader));
		if ($sha256_key < $this->diffcult) {
			// 暂时以创建一个区块来代替，这里可以改成以虚拟货币为回报的方式给与结算；
			$this->createBlock('挖矿奖励区块');



		}
	}

	function getHash() {
		return sha1($this->index.$this->prev_hash.$this->data.$this->timestamp.$this->diffcult);
	}
	function __get($name){
		if (!isset($this->$name)) {
			return false;
		} 
		return $this->$name;
	}
	
}

class BlockChain {
	private $chain;
	function __construct() {
		$this->createBlock('First Block');
		echo 'First Block have Created!';
	}
	}
	//创建区块链
	 function createBlock($data = null){
		$lastBlock = $this->getLastBlock();
		$index = $diffcult = 0;$hash = '';
		if ($lastBlock) {
			$index = $lastBlock->index; $index++;
			$diffcult = $lastBlock->diffcult; $diffcult++;
			$hash = $lastBlock->hash;
		} 
		$block = new Block($index, $hash, $data, time(), $diffcult);
		$this->chain[] = $block;
		
	}
	//得到上一个区块
	function getLastBlock(){
		$length = count($this->chain);
		if ( $length > 0) return $this->chain[$length-1];
		return false;
	}
	//区块链的自我验证
	function verify() {

	}
	function getChain() {
		return $this->chain;
	}
}
$bChain = new BlockChain();
print_r($bChain->getChain());