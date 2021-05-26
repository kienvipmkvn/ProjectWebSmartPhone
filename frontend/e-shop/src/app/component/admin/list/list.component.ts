import { Component, OnInit } from '@angular/core';
import { ProductService } from 'src/app/services/product.service';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent implements OnInit {

  listProduct = [];
  pageIndex = 0;
  pageSize = 10;
  constructor(private productService: ProductService) { }

  ngOnInit(): void {
    this.productService.getProductsPaging(this.pageIndex, this.pageSize).subscribe(res=>{
      this.listProduct = res.data;
    })
  }

}
