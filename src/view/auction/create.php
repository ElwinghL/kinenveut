<!--action :)-->

<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Créer une enchère</h3>
        </div>
        <div class="card-body">
            <form action="?r=auction/create" method="post">

                <div class="form-group col-md-10">

                    <label for="name">Objet</label>
                    <input class="form-control" name="name" type="text" id="name" value="" placeholder="Objet" maxlength="255" required/>

                    <br/>

                    <label for="description">Description</label>
                    <input class="form-control" name="description" type="text" id="description" value="" placeholder="Description" maxlength="255"/>

                    <br/>

                    <label for="basePrice">Prix de départ</label>
                    <input class="form-control" name="basePrice" type="number" id="basePrice" value="" placeholder="" step="any" required/>

                    <br/>

                    <label for="reservePrice">Prix de réserve</label>
                    <input class="form-control" name="reservePrice" type="number" id="reservePrice" value="" placeholder="" step="any"/>

                    <br/>


                    <!--                    <label for="pictureLink">Image</label>-->
                    <!--                    <input class="form-control" name="pictureLink" type="file" id="pictureLink" value=""/>-->

                    <br/>

                    <label for="startDate">Date de début</label>
                    <input class="form-control" type="datetime-local" name="startDate" id="startDate" value="" placeholder="Date de début" required/>

                    <br/>

                    <label for="endDate">Date de fin</label>
                    <input class="form-control" type="datetime-local" name="endDate" id="endDate" value="" placeholder="Date de fin" required/>

                    <br/>

                    <label for="privacyId">Confidentialité</label>
                    <select class="form-control" name="privacyId" id="privacyId" required/>
                    <option value="1" selected>Libre</option>
                    <option value="2">Privée</option>
                    <option value="3" >Confidentielle</option>
                    </select>

                    <br/>

                    <label for="categoryId">Catégories</label>
                    <select class="form-control" name="categoryId" id="categoryId">
                        <?php
                        $categories = new CategoryModel();
                        $data = $categories->getAllName();
                        foreach ($data as $r): ?>
                            <option value="<?= $r['id']; ?>"><?= $r['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br/>
                    <input class="btn btn-primary" type="submit" name="createBid" id="createBid" value="Valider"/>
                    <input class="btn btn-primary" type="submit" name="cancel" id="cancel" value="Annuler"/>
                </div>
            </form>
        </div>
    </div>
</div>