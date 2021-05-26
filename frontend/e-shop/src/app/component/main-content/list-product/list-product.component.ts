import { Component, OnInit } from '@angular/core';
import { BrandModel } from 'src/app/models/brand.model';
import { BrandService } from 'src/app/services/brand.service';

@Component({
  selector: 'app-list-product',
  templateUrl: './list-product.component.html',
  styleUrls: ['./list-product.component.css']
})
export class ListProductComponent implements OnInit {
  listBrand: BrandModel[] = [];
  constructor(private brandService: BrandService) { }

  ngOnInit(): void {
    this.brandService.getAllBrand().subscribe(rs=>{
      if(!rs.data) return;
      this.listBrand = rs.data;
    })
  }

}
