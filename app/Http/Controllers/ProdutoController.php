<?php namespace estoque\Http\Controllers;

use estoque\Produto;
use Request;
use estoque\Referencia;
use estoque\TipoDeCouro;
use estoque\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller{

	public function lista(){

		$produtos = Produto::all();
		return view('produtos/listagem')->with('produtos', $produtos);
		
	}

	public function novo(){
		$produtos = Produto::all();
		return view('produtos/formulario')->with('referencias', Referencia::all())->with('tipodecouros', TipoDeCouro::all());
	}

	public function adiciona(ProdutoRequest $request){
		Produto::create($request->all());
		return redirect()
		->action('ProdutoController@lista');
	}

	public function remove($id){
		$produto = Produto::find($id);
		$produto->delete();
		return redirect()->action('ProdutoController@lista');
	}
	//busca para alterar
	public function busca($id){
		$resposta = Produto::find($id);

		if(empty($resposta)) {
			return "Esse produto não existe";
		}
		return view('produtos/formularioAltera')->with('p', $resposta)->with('r', Referencia::all())->with('tipodecouros', TipoDeCouro::all());

	}

	public function alterado(ProdutoRequest $request, $id){

		$produto = Produto::find($id);
		$valores = $request->all();

		$produto->fill($valores)->save();

		return redirect()->action('ProdutoController@lista');


	}

	public function buscaParaVenda($id){
		$resposta = Produto::find($id);

		if(empty($resposta)) {
			return "Esse produto não existe";
		}
		return view('produtos/formularioVenda')->with('p', $resposta)->with('r', Referencia::all())->with('tipodecouros', TipoDeCouro::all());

	}

	public function venda($id){

		$produto = Produto::find($id);

		$qtdEmEstoque = Request::input('quantidade');
		$qtdVendida = Request::input('quantidadeVendida');

		$calculo = $qtdEmEstoque - $qtdVendida;
		
		$produto->quantidade = $calculo;
		$produto->save();

		return redirect()->action('ProdutoController@lista');

	}
}

/*
public function edit(Request $request,$id) {
      $name = $request->input('stud_name') ;
      DB::update('update student set name = ? where id = ?',[$name,$id]) ;
      echo "Record updated successfully.<br/>";
      echo '<a href = "/edit-records">Click Here</a> to go back.'; */