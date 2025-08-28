<x-layout title="articoli">
    <div class="container">
        <h1 class="text-center my-5">Aggiungi articolo</h1>
        <div class="row justify-content-center align-content-center">
            <div class="col-12 col-md-6 mb-5">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Nome articolo" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descrizione articolo"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="img" name="img">
                        @error('img')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Prezzo</label>
                        <input type="number" class="form-control" id="price" name="price"
                            placeholder="Prezzo articolo" value="{{ old('price') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="material" class="form-label">Materiale</label>
                        <input type="text" class="form-control" id="material" name="material"
                            placeholder="Materiale articolo" value="{{ old('material') }}" required>
                        @error('material')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Colore</label>
                        <input type="text" class="form-control" id="color" name="color"
                            placeholder="Colore articolo" value="{{ old('color') }}" required>
                        @error('color')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock"
                            placeholder="Stock articolo" value="{{ old('stock') }}" required>
                        @error('stock')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria sport</label>
                        <select class="form-control" id="category" name="category_id" required>
                            <option value="">Seleziona categoria sport</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="clothing_category" class="form-label">Categoria abbigliamento</label>
                        <select class="form-control" id="clothing_category" name="clothing_category_id" required>
                            <option value="">Seleziona categoria abbigliamento</option>
                            @foreach ($clothingCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('clothing_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('clothing_category_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="person_category" class="form-label">Categoria persona</label>
                        <select class="form-control" id="person_category" name="person_category_id" required>
                            <option value="">Seleziona categoria persona</option>
                            @foreach ($personCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('person_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('person_category_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom">Aggiungi articolo</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
