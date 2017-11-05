@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Meus Conhecimentos</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <form method="POST" action="{{ route('conhecimento.add') }}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <select class="w3-select" name="tecnologia" required>
                    <option value="" disabled selected>Escolha a tecnologia</option>
                    @foreach ($conhecimentos as $conhecimento)
                    <option  value="{{ $conhecimento->id }}">{{ $conhecimento->titulo . '/' . $conhecimento->descricao . '/' . $conhecimento->nivel }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {{-- <input class="w3-button w3-circle w3-black add-conhecimento" type="input" value="+" title="Adicionar tecnologia"> --}}
                  <input type="submit" value="Adicionar">
                </div>
              </div>
            </div>
          </form>

          <table class="w3-table w3-centered w3-bordered table-conhecimentos">
            <tr>
              <th>Tecnologia</th>
              <th>Descrição</th>
              <th>Nível</th>
              <th>Ações</th>
            </tr>
            @foreach ($freelancer->conhecimentos as $conhecimento)
            <tr>
              <td>{{ $conhecimento->titulo }}</td>
              <td>{{ $conhecimento->descricao }}</td>
              <td>{{ $conhecimento->nivel }}</td>
              <td><a href="/empresa/conhecimento/excluir/{{ $conhecimento->id }}" class="w3-button w3-red w3-small" title="Remover o conhecimento">Remover</a>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Column -->
  </div>
  @endsection