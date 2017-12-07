@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Lista de pontuações</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <h4 class="w3-opacity animate-bounce">Minha pontuação: {{ $total }} pontos</h4>
          <table class="w3-table w3-centered w3-bordered table-conhecimentos">
            <tr>
              <th>Descrição</th>
              <th>Valor</th>
              <th>Status</th>
            </tr>
            @foreach ($pontuacoesEmpresa as $pontuacao)
            <tr>
              <td>{{ $pontuacao->descricao }}</td>
              <td>{{ $pontuacao->valor }} pontos</td>
              <td style="color: #4CAF50">Concluído</tr>
                @endforeach
              </table>
              <hr>
              <h4 class="w3-opacity">Mais pontuações</h4>
              <table class="w3-table w3-centered w3-bordered table-conhecimentos">
                <tr>
                  <th>Descrição</th>
                  <th>Valor</th>
                  <th>Status</th>
                </tr>
                @foreach ($pontuacoes as $pontuacao)
                <tr>
                  <td>{{ $pontuacao->descricao }}</td>
                  <td>{{ $pontuacao->valor }} pontos</td>
                  <td style="color: #f44336;">Não concluído</tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- End Middle Column -->
        </div>
        @endsection